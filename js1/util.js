AjaxTCR.util = {
	enableDOMShorthand : true,

	/**
	 * Find elements by class, will be overriden by native if found
	 * If startNode is specified, starts the search there, otherwise starts at document. 
	 * 
	 * @param 	classToFind	the string class name to search for 
	 * @param	startNode	the DOM node to start the search at.  Default is the document node. 
	 * @return 	array of elements that match the given class name.
	 */
	getElementsByClassName : function(classToFind,startNode){ 	
								  if (document.getElementsByClassName)
								    return document.getElementsByClassName(classToFind,startNode);
										
								  /* find all the elements within a particular document or in the whole document */
								  var elements;
								  if (startNode)
								   elements = startNode.getElementsByTagName("*");
								  else
								   elements = document.getElementsByTagName("*");
								   
								  var classElements = new Array();
								  var classCount = 0;  
								  
								  var pattern = new RegExp("(^|\\s)"+classToFind+"(\\s|$)");
								  
								  /* look over the elements and find those who match the class passed */
								  for (var i = 0; i < elements.length; i++)
								    if (pattern.test(elements[i].className) )
								        classElements[classCount++] = elements[i];
										
								  return classElements;
							},	

	/**
	 * Returns element or element array specified by given string or strings.
	 * 
	 * @param	element(s) 	strings to search for element.
	 * @param 	startNode	the DOM node to start the search at.  Default is the document node.
	 * @return	if single string, it returns the element.  Otherwise it returns an array of elements
	 */
	getElementsById : function(){
									var elements = new Array();
									var startNode = document;
									var length = arguments.length;
									if (typeof(arguments[length-1]) == "object" && arguments[length-1] != document)
									{
										startNode = arguments[length-1];
										length--;
										var allElements = startNode.getElementsByTagName("*");
										for (var j=0; j<allElements.length; j++)
										{
											for (var i=0;i<length;i++)
											{
								   				if (allElements[j].id == arguments[i])
												{
								        			elements.push(allElements[j]);
													break;
												}
											}
										}
									}
									else
									{
										if (arguments[length-1] == document)
											length--;
											
										for (var i=0; i<length; i++)
										{
											var elm = document.getElementById(arguments[i]);
											if (elm != null)
									    		elements.push(elm);
										}
									}
									
									if (elements.length == 1)
										return elements[0];
									else if (elements.length > 0)
										return elements;
									else
										return null;
								},
		
	/**
	 * Modified version of getElementById to return single node match.
	 * If startNode is not set to document, it starts the search at the node
	 * If deepSearch is set to true, it does not use getElementById, but instead loops through the whole structure.
	 * 
	 * @param id 			the string to match with the id attribute
	 * @param startNode		the DOM node to start searching in the document
	 * @param deepSearch	true if wanted to search node by node instead of document.getElementById
	 */						
	getElementById : function(id, startNode, deepSearch){
								if (!startNode)
									startNode = document;
								
								if (startNode == document && !deepSearch)
									return document.getElementById(id);
								else
								{
									var allElements = startNode.getElementsByTagName("*");
									for (var j=0; j<allElements.length; j++)
									{
										if (allElements[j].getAttribute("id") == id)
										{
									   		return allElements[j];
											break;
										}
									}
								}



	},
	
		
	/**
	 * 
	 * @param 	selector		string indicating the selection to match
	 * @param 	treeRoot		DOM element to start search.  Default is the document node
	 * @param 	selectorType	string to indicate CSS or XPATH.  Default is CSS
	 * @return 	array of matching elements
	 * 
	 */						
	getElementsBySelector : function(selector,treeRoot,selectorType){
								var matches = new Array();
								var parents = new Array();
								var savematches = new Array();
								if (treeRoot)
								{
									if (treeRoot.length)
									{
										for (var i=0;i<treeRoot.length;i++)
											parents.push(treeRoot[i]);
									}
									else
										parents.push(treeRoot);
								}
								else
									parents.push(document);
									
								if (!selectorType)
									selectorType = "CSS";
								if (selectorType.toUpperCase() == "CSS")
								{
									selector = selector.replace(/([>\+,])/g, " $1 ").replace(/[\s]+/g," ");
									 
									var selectors = selector.split(" ");
									while (selectors.length > 0)
									{
										var curSelector = selectors.shift();
										if (curSelector == "")
											continue;
											
										/* check for expressions */
										var options = {};
										switch(curSelector.charAt(0))
										{
											case(">"):
												options.type = "childOnly";
											break;
											case("+"):
												options.type = "nextSibling";
											break;
											case ("~"):
												options.type = "futureSibling";
											break;
											case(","):
												while(matches.length > 0)
													savematches.push(matches.shift());
								
												parents.length = 0;					
												if (treeRoot)
													parents.push(treeRoot);
												else
													parents.push(document);
								
												continue;
											break;
										}
										
										if (options.type)
										{
											if (curSelector.length == 1)
												curSelector = selectors.shift();
											else
												curSelector = curSelector.substring(1);
										}
										
										/* Check to see if we already looped though.  If so, we have a different starting point */
										if (matches.length)
										{
											parents.length = 0;
											while(matches.length > 0)
												parents.push(matches.shift());
										}
										
										
										/* Check for Pseudo-classes */
										if (curSelector.indexOf(":") > -1)
										{
											var newSelector = curSelector.substring(0, curSelector.indexOf(":"));
											var optionsType = curSelector.substring(curSelector.indexOf(":")+1);
											
											curSelector = newSelector;
											options.type = optionsType.toLowerCase();
											
											if (options.type.indexOf("nth-child") == 0)
											{
												options.childNumber = options.type.substring(10,options.type.length-1);
												options.type = "nth-child";
											}
											else if (options.type.indexOf("not") == 0)
											{
												//use optionsType to preserve case
												options.notString = optionsType.substring(4,options.type.length-1).replace(/^\s+|\s+$/g,"");
												options.type = "not";
												var notSelector = curSelector;
												if (notSelector == "*")
													notSelector = "";
												if (/^[:#\[\.].*/.test(options.notString))
													options.notSelector = notSelector + options.notString;
												else
													options.notSelector = notSelector + " " + options.notString;
												
												options.notObjects = AjaxTCR.util.getElementsBySelector(options.notSelector, parents);	
											}
										}
										
										/* Check for Attributes */
										if (curSelector.indexOf("[") > -1)
										{
											var tokens = curSelector.split("[");
											curSelector = tokens[0];
											options.type = "attribute";
											options.attribute = tokens[1].substring(0,tokens[1].length-1).toLowerCase();
										}
										
										if (curSelector == "")
											curSelector = "*";
										
										/* Inspect class selectors */
										if (curSelector.indexOf(".") > -1)
										{
											/* Cases:
											 * p.class1
											 * .class2
											 * div.class1.class2
											 */
											var classNames = curSelector.split(".");
											var elementName = classNames.shift();
											/* First get the element at the beginning if necessary */
											if (elementName != "")
											{
												for (var j=0;j<parents.length;j++)
												{
													var elms = AjaxTCR.util.getElementsByTagName(parents[j],elementName,options);
													for (var k=0;k<elms.length;k++)
													{
														if (checkFilter(elms[k], parents[j], options))
															matches.push(elms[k]);
													}
												}
											}
											else if (classNames.length > 0)
											{
												/* if no element is specified, use getElementsByClassName for the first class */
												var firstClass = classNames.shift();
												for (var j=0;j<parents.length;j++)
												{
													var elms = AjaxTCR.util.getElementsByClassName(firstClass, parents[j]);
													for (var k=0;k<elms.length;k++)
													{
														if (checkFilter(elms[k],parents[j],options))
															matches.push(elms[k]);
													}
												}
											}
										
											/* Now get the (rest of the) classes */
											for (var j=matches.length-1;j>=0;j--)
											{
												for (var k=0;k<classNames.length;k++)
												{
													var pattern = new RegExp("(^|\\s)"+classNames[k]+"(\\s|$)");
													if (!pattern.test(matches[j].className))
													{
														matches.splice(j,1);
														break;
													} 
												}
											}
										}
										
										/* Inspect id selectors */
										else if (curSelector.indexOf("#") > -1)
										{
											/* Cases:
											 * p#id1
											 * #id2
											 */
											var idNames = curSelector.split("#");
											var elementName = idNames[0];
											var id = idNames[1];
											
											/* First get the element at the beginning if necessary */
											if (elementName != "")
											{
												for (var j=0;j<parents.length;j++)
												{
													var elms = AjaxTCR.util.getElementsByTagName(parents[j],elementName,options);
													for (var k=0;k<elms.length;k++)
													{
														if (elms[k].id == id && checkFilter(elms[k], parents[j], options))  
															matches.push(elms[k]);
													}
												}
											}
											else
											{
												for (var j=0;j<parents.length;j++)
												{
													var elms = AjaxTCR.util.getElementsById(id, parents[j]);
													if (checkFilter(elms, parents[j], options))
														matches.push(elms);
												}
											}
										}
										/* Simple tagname selects */
										else
										{
											for (var j=0;j<parents.length;j++)
											{
												var elms =AjaxTCR.util.getElementsByTagName(parents[j],curSelector,options);
												for (var k=0;k<elms.length;k++)
												{
													if (checkFilter(elms[k], parents[j], options))
														matches.push(elms[k]);
												}
											}
										}						
									}
								}
								
								
								function checkFilter(element, parent, options)
								{
									var valid = false;
									
									if (element == null)
										return false;
									else if (!options.type)
										return true;
										
									//handle the case of the parent element being the document	
									if (parent == document)
									{
										var allElms = document.getElementsByTagName("*");
										for (var i=0;i<allElms.length;i++)
										{
											if( checkFilter(element, allElms[i], options))
											{
												valid = true;
												break;
											}
										}
									
										return valid;
									}
									
									
									if (options.type == "childOnly")
										valid = (element.parentNode == parent);
									else if (options.type == "nextSibling")
									{
										var elm = parent.nextSibling;
										while (elm != null && elm.nodeType != 1)
											elm = elm.nextSibling;
										valid = (elm == element);
									}
									else if (options.type == "futureSibling")
									{
										var elm = parent.nextSibling;
										while (elm != null)
										{
											if (elm == element)
											{
												valid = true;
												break;
											}
											elm = elm.nextSibling;
										}
									}	
									else if (options.type == "first-child")
									{
										var elm = parent.firstChild;
										while (elm != null && elm.nodeType != 1)
											elm = elm.nextSibling;
										valid = (elm == element); 
									}		
									else if (options.type == "last-child")
									{
										var elm = parent.lastChild;
										while (elm != null && elm.nodeType != 1)
											elm = elm.previousSibling;
										valid = (elm == element); 
									}
									else if (options.type == "only-child")
									{
										var elm = parent.firstChild;
										while (elm != null && elm.nodeType != 1)
											elm = elm.nextSibling;
										
										if (elm == element)
										{
											var elm = parent.lastChild;
											while (elm != null && elm.nodeType != 1)
												elm = elm.previousSibling;
										}
										
										valid = (elm == element);
									}
									else if (options.type == "nth-child")
									{
										var count = 0;
										var elm = parent.firstChild;
										while (elm != null  && count < options.childNumber)
										{
											if (elm.nodeType == 1)
												count++;
											
											if (count == options.childNumber)
												break;
											
											elm = elm.nextSibling;
										}
										 
										valid = (elm == element);
									}
									else if (options.type == "empty")
										valid = (element.childNodes.length == 0);
									else if (options.type == "enabled")
										valid = (!element.disabled);
									else if (options.type == "disabled")
										valid = (element.disabled);
									else if (options.type == "checked")
										valid = (element.checked);
									else if (options.type == "selected")
										valid = (element.selected);
									else if (options.type == "attribute")
									{
										var pattern = /^\s*([\w-]+)\s*([!*$^~=]*)\s*(['|\"]?)(.*)\3/;
										var attRules = pattern.exec(options.attribute);
										
										if (attRules[2] == "")
											valid = element.getAttribute(attRules[1]);
										else if (attRules[2] == "=")
											valid = (element.getAttribute(attRules[1]) && element.getAttribute(attRules[1]).toLowerCase() == attRules[4].toLowerCase());
										else if (attRules[2] == "^=")
											valid = (element.getAttribute(attRules[1]) && element.getAttribute(attRules[1]).toLowerCase().indexOf(attRules[4].toLowerCase()) == 0);
										else if (attRules[2] == "*=")
											valid = (element.getAttribute(attRules[1]) && element.getAttribute(attRules[1]).toLowerCase().indexOf(attRules[4].toLowerCase()) > -1);
										else if (attRules[2] == "$=")
										{
											var att =element.getAttribute(attRules[1]);
											if (att)
												valid =  (att.toLowerCase().substring(att.length - attRules[4].length) == attRules[4].toLowerCase()); 
										}										
									}
									else if (options.type == "not")
									{
										valid = true;
										for (var j=0;j<options.notObjects.length;j++)
										{
											if (options.notObjects[j] == element)
											{
												valid = false;
												break;
											}
										}
									}
									
									
									return valid;					
								}
								
								//get the results in the correct order
								if (savematches.length)
								{
									while(matches.length > 0)
										savematches.push(matches.shift());
									while(savematches.length > 0)
										matches.push(savematches.shift());
								}
								return matches;
							},	
							
		
/**
 * Custom getElementsByTagName that takes various options into consideration before returning the values
 * 
 * @param parentElm	element to begin the search at
 * @param tag		string to match tagName to
 * @param options
 */					
getElementsByTagName : function(parentElm, tag, options){
								var matches = new Array();
								if (!options.type)
									return parentElm.getElementsByTagName(tag);
								
								
								if (options.type == "nextSibling")
								{
									var elm = parentElm.nextSibling;
									while (elm && elm.nodeType != 1)
										elm = elm.nextSibling;
									
									if (checkTagMatch(elm, tag))
										matches.push(elm);
								}
								else if (options.type == "futureSibling")
								{
									var elm = parentElm.nextSibling;
									while (elm)
									{
										if (checkTagMatch(elm, tag))
										{
											matches.push(elm);
											//break;
										}
										elm = elm.nextSibling;
									}	
								}
								else
									matches = parentElm.getElementsByTagName(tag);
								
								function checkTagMatch(element, tag)
								{
									return (element && element.tagName && (tag == "*" || element.tagName.toUpperCase() == tag.toUpperCase()));
								}
										
								return matches;
							},

insertAfter : function(parent, obj, sibling){
												if (parent && obj && sibling && sibling.nextSibling)
													parent.insertBefore(obj, sibling.nextSibling);
												else if (parent && obj)
													parent.appendChild(obj);
											},

getCookie : function(name){
							        var fullname = name + "=";
							        var cookies = document.cookie.split(';');
							        for(var i=0;i < cookies.length;i++)
							        {
							        	var cookieNV = cookies[i];
							            while (cookieNV.charAt(0)==' ') 
											cookieNV = cookieNV.substring(1);
							            if (cookieNV.indexOf(fullname) == 0) 
											return cookieNV.substring(fullname.length);
							        }
							        return null;
							},


							
enableAjax : function(options, parent, currentURL)	{
														if (!parent)
															parent = document;
															
														AjaxTCR.history.init(function(){});
														
														//set defaults to be used in case not set through link
														var defaultOptions = new Object();
														defaultOptions.insert = "replace";
														defaultOptions.method = "GET";
														defaultOptions.ajaxifyByDefault = false;
														defaultOptions.ajaxifyResponse = true;
														
														/* apply options defined by user */
													    for (option in options)
													      defaultOptions[option] = options[option];
																
														var as = parent.getElementsByTagName("a");
														for (var i=0;i<as.length;i++)
															modifyLink(as[i], defaultOptions, currentURL);
														
														function modifyLink(a, defaultOptions, currentURL)
														{
															var ajaxify = a.getAttribute("ajaxify");
															if (ajaxify == "true" || (ajaxify == null && defaultOptions.ajaxifyByDefault))
															{
																var target = (a.getAttribute("ajaxtarget")) ? a.getAttribute("ajaxtarget") : defaultOptions.target;
																var insert = (a.getAttribute("ajaxinsert")) ? a.getAttribute("ajaxinsert") : defaultOptions.insert;
																var method = (a.getAttribute("ajaxmethod")) ? a.getAttribute("ajaxmethod") : defaultOptions.method;
																var ajaxifyResponse = (a.getAttribute("ajaxifyresponse")) ? a.getAttribute("ajaxifyresponse") : defaultOptions.ajaxifyResponse;
																	
																var url = a.getAttribute("href");
																if (currentURL)
																{
																	currentURL = currentURL.substring(0, currentURL.lastIndexOf("/"));
																	url = AjaxTCR.util.calculateFullPath(currentURL, url);
																}
																
																var sendRequest = function(){
																	var options = {method: method,
																				   insertType: insert,
																				   outputTarget: target,
																				   ajaxifyResponse: ajaxifyResponse,
																				   ajaxifyByDefault: defaultOptions.ajaxifyByDefault/*,
																				   history: {id:url}*/};
																	AjaxTCR.comm.sendRequest(url, options);
																}																
																
																var oldOnClick = a.onclick;
																a.onclick = function(e){
																	if (oldOnClick)
																		oldOnClick(e);
																	sendRequest();
																	return false;
																};
																 
															} 
														}
													},

calculateFullPath : function(currentPath, relativePath){
	
													var safePath;
													if (relativePath.indexOf("..") > -1)
													{
														safePath = currentPath.substring(0, currentPath.lastIndexOf("/"));
															 
														//WE HAVE TO MOVE UP AS THERE ARE ../
														while (relativePath.indexOf("..") == 0)
														{
															safePath = currentPath.substring(0, currentPath.lastIndexOf("/"));
															relativePath = relativePath.substring(3);
														}
												
														safePath += relativePath;
													}
													else if (relativePath.indexOf("/") == 0 ||relativePath.indexOf("./") == 0)
													{
														safePath = relativePath;
													}
													else if (relativePath.indexOf("http://") == 0)
													{
														//POSSIBLY AN EXTERNAL LISTING
														var domainCurrent = currentPath.substring(7);
														domainCurrent = domainCurrent.substring(0, domainCurrent.indexOf("/"));
														var domainNew = relativePath.substring(7);
														domainNew = domainNew.substring(0, domainNew.indexOf("/"));
														
														if (domainCurrent == domainNew)
															safePath = relativePath;
														else
															safePath = null;
													}
													else if (relativePath.indexOf("#") == 0)
														safePath = null;
													else
														safePath = currentPath + "/" + relativePath;
													
													return safePath;
	}												   
};


if (AjaxTCR.util.enableDOMShorthand)
{
   if (typeof($id) == "undefined") $id = AjaxTCR.util.getElementsById;
   if (typeof($class) == "undefined") $class = AjaxTCR.util.getElementsByClassName;  
   if (typeof($selector) == "undefined") $selector = AjaxTCR.util.getElementsBySelector;
}
	