jQuery.form = {
    set:function(form,name,values)
    {
        var selector = "."+form+"[name="+name+"]";
        if ($(selector).is(':checkbox'))
        {
            if (!$.isArray(values)) values = new Array(values);
            $(selector).removeAttr("checked");
            for (var i = 0; i < values.length; i++)
                $(selector+"[value='"+values[i]+"']").attr("checked","checked");
            return;
        }
        if ($(selector).is(':radio'))
        {
            $(selector).removeAttr("checked");
            $(selector+"[value='"+values+"']").attr("checked","checked"); return;
        }
        if ($(selector).is('select'))
        {
            if (!$.isArray(values)) values = new Array(values);
            $(selector).children('option').removeAttr("selected");
            for (var i = 0; i < values.length; i++)
                $(selector).children("[value='"+values[i]+"']").attr("selected","selected");
            return;
        }
        $(selector).attr("value",values);
    },
        
    get:function(form,json,multi){
        if (multi == null) multi = false;
        if (json == null) json = true;
        if (form == null || form.length == 0)
        {
            if (!json) return {};
            else return $.toJSON({});
        }
        var selector = "input."+form+":radio:checked,input."+form+":checkbox:checked,input."+form+":text,input."+form+":hidden,input."+form+":file,input."+form+":password,textarea."+form+",select."+form;
        var inputs = $(selector);
        var values = {};   
            
        $.each(inputs,function(){

            var name = $(this).attr("name");
            var value = $(this).val(); 
                   
            if (($.isArray(value) && value[0] == null) || value == null)
                return;
            if (multi || $(this).is(':checkbox'))
            {
                if (values[name] == null) values[name] = new Array();
                values[name][values[name].length] = value;
            }
            else
            {
                values[name] = value;
            }
        });

        if (json == false)
            return values;
        else
            return $.toJSON(values);
    },
}