<%@ Register TagPrefix="DNG" TagName="DotNetGraph" Src="dummy2.ascx" %>

<script language="C#" runat="server">

    void Page_Load(Object sender, EventArgs e) {            
    
        // Declare our variables
        String [] sItems = new String[10];
        Int32 [] iValue = new Int32 [10];

        // Populate our variables
        sItems[0] = "Carrots";
        iValue[0] = 23;
        
        sItems[1] = "Peas";
        iValue[1] = 53;
        
        sItems[2] = "Celery";
        iValue[2] = 11;
        
        sItems[3] = "Onions";
        iValue[3] = 21;
        
        sItems[4] = "Radishes";
        iValue[4] = 43;
        
        // Set our axis values
        dngchart.YAxisValues = iValue;
        
        // Set our axis strings
        dngchart.YAxisItems  = sItems;            
        
        // Provide a title
        dngchart.ChartTitle  = "<b>Inventory Breakdown:</b>";
        
        // Provide an title for the X-Axis
        dngchart.XAxisTitle  = "(units display actual numbers)";        
        
    }
            
</script>

<html>
<body>
<!-- Note UserWidth is set "in-line".  It could just as easily been set on the page_load method. -->
<DNG:DotNetGraph id=dngchart UserWidth=200 runat=server />
</body>
</html>
