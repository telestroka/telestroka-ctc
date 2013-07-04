		<!-- Ётот блок кода нужно вставить в ту часть страницы, где вы хотите разместить карту  (начало) -->
<script src="http://api-maps.yandex.ru/1.1/?key=AMJt0UsBAAAAX380RwIA6CfwxQh2xb6dhkrxrm4PYuikTSMAAAAAAAAAAADFi_GiDLgE7DE8_4w3skcvSOYQ4Q==&wizard=constructor" type="text/javascript"></script>
<script type="text/javascript">
    YMaps.jQuery(function () {
        var map = new YMaps.Map(YMaps.jQuery("#YMapsID-1251")[0]);
        map.setCenter(new YMaps.GeoPoint(82.903226,55.033389), 16, YMaps.MapType.MAP);
        map.addControl(new YMaps.Zoom());
        map.addControl(new YMaps.ToolBar());
        map.addControl(new YMaps.TypeControl());

        YMaps.Styles.add("constructor#pmpnlPlacemark", {
            iconStyle : {
                href : "http://api-maps.yandex.ru/i/0.3/placemarks/pmpnl.png",
                size : new YMaps.Point(36,41),
                offset: new YMaps.Point(-13,-40)
            }
        });

       map.addOverlay(createObject("Placemark", new YMaps.GeoPoint(82.902861,55.031851), "constructor#pmpnlPlacemark", "теле—“–ќ ј<br/>Ћенина, 53 оф.(кв.) 27<br/>263-31-76, ф. 210-09-95"));
        
        function createObject (type, point, style, description) {
            var allowObjects = ["Placemark", "Polyline", "Polygon"],
                index = YMaps.jQuery.inArray( type, allowObjects),
                constructor = allowObjects[(index == -1) ? 0 : index];
                description = description || "";
            
            var object = new YMaps[constructor](point, {style: style, hasBalloon : !!description});
            object.description = description;
            
            return object;
        }
    });
</script>

<div id="YMapsID-1251" style="width:519px;height:347px"></div>
<!--div style="width:519px;text-align:right;font-family:Arial"><a href="http://api.yandex.ru/maps/tools/constructor/" style="color:#1A3DC1">—оздано с помощью инструментов яндекс. арт</a></div-->
<!-- Ётот блок кода нужно вставить в ту часть страницы, где вы хотите разместить карту (конец) -->
	