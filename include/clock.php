<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<script type="text/javascript">
    tday = new Array("  ראשון", "  שני", "  שלישי", " רביעי", "  חמישי", "  שישי", " שבת");
    tmonth = new Array(" / 1 / ", " / 2 / ", " / 3 / ", " / 4 / ", " / 5 / ", " / 6 / ", " / 7 / ", " / 8 / ", " / 9 / ", " / 10 / ", " / 11 / ", " / 12 / ");

    function GetClock() {
        var d = new Date();
        var nday = d.getDay(), nmonth = d.getMonth(), ndate = d.getDate(), nyear = d.getYear(), nhour = d.getHours(),
            nmin = d.getMinutes(), nsec = d.getSeconds(), ap;

        if (nhour == 0) {
            ap = " AM";
            nhour = 12;
        } else if (nhour < 12) {
            ap = " AM";
        } else if (nhour == 12) {
            ap = " PM";
        } else if (nhour > 12) {
            ap = " PM";
            nhour -= 12;
        }

        if (nyear < 1000) nyear += 1900;
        if (nmin <= 9) nmin = "0" + nmin;
        if (nsec <= 9) nsec = "0" + nsec;

        document.getElementById('clockbox').innerHTML = "" + tday[nday] + " " + ndate + "" + tmonth[nmonth] + "" + nyear + "  <br>  " + nhour + ":" + nmin + ":" + nsec + ap + "";
    }

    window.onload = function () {
        GetClock();
        setInterval(GetClock, 1000);
    }
</script>