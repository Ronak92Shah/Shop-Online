<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:output method="html" indent="yes" version="4.0" />
		<xsl:template match="/">
			<table border="1">
			
			<tr>
			<td>surburb</td>
			<td>street_address</td>
			<td>price</td>
			<td>type</td>
			<td>bedrooms</td>
			<td>bathrooms</td>
			<td>garage</td>
			<td>contact</td>
			</tr>
			
			
<xsl:for-each select="//property[price &lt;=400]">

<tr>
</xsl:value-of select="address/suburb"/>
</xsl:value-of select="concat(address/streetNo, ' ', address/street)"/>
</xsl:value-of select="price"/>
</xsl:value-of select="type"/>
</xsl:value-of select="numberOfBedrooms"/>
</xsl:value-of select="numberOfBathrooms"/>
</xsl:value-of select="garage"/>
</xsl:value-of select="description"/>
</tr>
</xsl:for-each>
</table>

<br />total number of properties: <xsl:value-of select="count(//property)"/>
<br />average Price: <xsl:value-of select="sum(//property/price) div count(//property)"/>
<br />total number of properties with cheap rentals: <xsl:value-of select="count(//property[price &lt;= 400])"/>

</xsl:template>
</xsl:stylesheet>