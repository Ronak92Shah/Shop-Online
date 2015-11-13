

function show()
{ if ((xHRObject.readyState == 4) &&(xHRObject.status == 200))
{ if (window.ActiveXObject) // IE
{ //Load XML and XSL, then transform
//Load XML and XSL
var xml = new ActiveXObject("Microsoft.XMLDOM");
xml.async = false;
xml.load(“rental.xml");
var xsl = new ActiveXObject("Microsoft.XMLDOM");
xsl.async = false;
xsl.load(“table.xsl");
//Transform
var transform = xml.transformNode(xsl);
//Write to screen
var spantag = document.getElementById("example");
spantag.innerHTML = transform;
}
else
{
	var xsltProcessor = new XSLTProcessor();
//Load XSL and XML
xslStylesheet = document.implementation.createDocument("","doc", null);
xslStylesheet.async = false;
xslStylesheet.load(“table.xsl");
xsltProcessor.importStylesheet(xslStylesheet);
xmlDoc = document.implementation.createDocument("", "doc",null);
xmlDoc.async = false;
xmlDoc.load(“rental.xml");
//Transform
var fragment = xsltProcessor.transformToFragment(xmlDoc,document);
document.getElementById("example").appendChild(fragment);
	
	
}