function CssEngine() {
	
	
	this. cssText = '';
	this.domNode = null;
	this.multiOccurence = '';
	
	
	
}

CssEngine.prototype.upperCaseOccurence = function (str) {
	
	
var i=0;
var character ='';
while (i <= str.length){
    character = str.charAt(i);
    if (!isNaN(character * 1)){
    	
    }else{
    	if (character == character.toUpperCase()) {
    		return i;
    	}
    	
    }
    i++;
}
	
}


CssEngine.prototype.multipleUpperCaseOccurence = function (str) {
	
this.multiOccurence = '';
	
var i=0;
var count = 0;
var character ='';
while (i <= str.length){
    character = str.charAt(i);
    if (!isNaN(character * 1)){
    	
    }else{
    	if (character == character.toUpperCase()) {
    		count++;
			if(this.multiOccurence == '')
			this.multiOccurence = i;
			else
			this.multiOccurence = this.multiOccurence+','+i;
    		//alert(this.multiOccurence);
		
		}
    	
    }
    i++;
}
//alert(str+"---"+this.multiOccurence);
return count;	
}




CssEngine.prototype.loadNode = function(node) {
	
	this.domNode = node;
	
}

CssEngine.prototype.getCssText = function() {
	
	
	
	return this.cssText;
}

CssEngine.prototype.refreshCssText = function() {
	
	this.cssText = '';
	
	
}

CssEngine.prototype.isNumber = function(n) 
{
  return !isNaN(parseFloat(n)) && isFinite(n);
}



CssEngine.prototype.prepareCss = function(element) {

	
	
	this.loadNode(element);
	
	var style = this.domNode.style;
	var styleName = '';
	var suffix ='';
	var nodeId = '#'+this.domNode.id;
	
	this.cssText = this.cssText+'\n'+nodeId+'\n{';
	
	var pos = -1;   // position of first uppercase property
	
	/*  iterating over style objects  of its own node     */
	
for (var property in style)
{
    	//pos = -1;
    	
    	
    	
    	
    	if (style.hasOwnProperty(property))
        {
        	
        	if(!style[property])
    		continue;
    		
    		if(this.isNumber(property.substr(0)))
    		continue;
			
			if(property === "cssText")
			continue;
    		
        	pos = this.upperCaseOccurence(property);
        	var m = this.multipleUpperCaseOccurence(property);
			//alert(this.multiOccurence);
			//alert(m);
			if(m>1)
			{
			var cn = this.multiOccurence.split(',');
			var i=0;
			while(i<=cn.length)
			{
	        	
				if(i==0)
				styleName = property.substr(0, cn[0]);
	        	
				else if(i==cn.length)
				{
					
					suffix = property.substr(cn[i-1],cn[i-1]- cn.length);
					//alert(cn.length - cn[i-1]);
	        		
	        		suffix = suffix.charAt(0).toLowerCase() + suffix.substr(1);
				
	        		//alert(property+"-"+suffix);
	        		styleName = styleName+'-'+suffix;

				}
				
				else
				{
					suffix = property.substr(cn[i-1],cn[i]-cn[i-1]);
					//alert(suffix);
	        		
	        		suffix = suffix.charAt(0).toLowerCase() + suffix.substr(1);
				
	        		//alert(property+"-"+suffix);
	        		styleName = styleName+'-'+suffix;
				}
				
				
				i++;
			}





			}
			
   			else if(m==1)
        	{
	        	
	        	styleName = property.substr(0, pos);
	        	suffix = property.substr(pos,property.length);
	        	//alert(suffix.charAt(0).toLowerCase());
	        	suffix = suffix.charAt(0).toLowerCase() + suffix.substr(1);
				
	        	//alert(property+"-"+suffix);
	        	styleName = styleName+'-'+suffix;
	        	
	        	
	        		        	
        	}
        	
        	else
        		{
        		styleName = property;
        		
        		}
        
       // console.log(property+"p");
        this.cssText = this.cssText+'\n\t'+styleName+':'+style[property]+';';
        	
        
        
        }


}


this.cssText = this.cssText+'\n}';
	
	
}

