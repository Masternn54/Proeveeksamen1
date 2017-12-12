var obj, dbParam, xmlhttp, myObj, x, txt = "";
obj = { "table":"customers",  "limit":20 };
dbParam = JSON.stringify(obj);
xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        myObj = JSON.parse(this.responseText);
        txt += "<table border='1'>"
        for (x in myObj) {
            txt += "<tr><td>" + myObj[x].ORD_ID + "</td>";
            txt += "<td>" + myObj[x].ORD_DATE + "</td>";
            txt += "<td>" + myObj[x].ORD_DESCRIPTION + "</td>";
            txt += "<td>" + myObj[x].ORD_AMOUNT + "</td>";
            txt += "<td>" + myObj[x].AGENT_NAME + "</td>";
            txt += "<td>" + myObj[x].CUST_NAME + "</td></tr>";
        }
        txt += "</table>"
        document.getElementById("demo").innerHTML = txt;
    }
};
xmlhttp.open("POST", "http://localhost/Proeveeksamen1/json_api.php", true);
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlhttp.send("x=" + dbParam);