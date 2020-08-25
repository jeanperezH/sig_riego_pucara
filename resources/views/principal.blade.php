<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="img/fis_uncp.png">
    <title>SIG-RIEGO</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Icons -->
    <link href="css/plantilla.css" rel="stylesheet">
    <!--SIG-->
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="stylesheet" href="css/leaflet.css">
    <link rel="stylesheet" href="css/qgis2web.css"><link rel="stylesheet" href="css/fontawesome-all.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <style>
        #map {
        width: 100%;
        height: 579px;
        }
    </style>
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    <div id="app">
        <header class="app-header navbar">
            <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
              <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
              <span class="navbar-toggler-icon"></span>
            </button>
            <ul class="nav navbar-nav d-md-down-none">
                <li class="nav-item px-3">
                    <a class="nav-link" href="#">Escritorio</a>
                </li>
            </ul>
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item d-md-down-none">
                    
                </li>
                <li class="nav-item dropdown">
                    
                </li>
            </ul>
        </header>
    
        <div class="app-body">
            <!-- sidebar -->
            @include('plantilla.sidebar')
            <!-- sidebar -->
    
            <!-- Contenido Principal -->
            @yield('contenido')
            <!-- /Fin del contenido principal -->
        </div>
    
    </div>
    
    

    <footer class="app-footer">
        <span><h4>SIG RIEGO - PUCARÁ</h4></span>
        <span class="ml-auto">FIS-UNCP-2020 <a href="#">FIS-UNCP</a></span>
    </footer>

    <script src="js/app.js"></script>
    <script src="js/plantilla.js"></script>
    
    <!--SIG-->
    <script src="js/contactform.js"></script>
    <script src="js/qgis2web_expressions.js"></script>
    <script src="js/leaflet.js"></script>
    <script src="js/multi-style-layer.js"></script>
    <script src="js/leaflet.rotatedMarker.js"></script>
    <script src="js/leaflet.pattern.js"></script>
    <script src="js/leaflet-hash.js"></script>
    <script src="js/Autolinker.min.js"></script>
    <script src="js/rbush.min.js"></script>
    <script src="js/labelgun.min.js"></script>
    <script src="js/labels.js"></script>
    <script src="data/Zonas_2.js"></script>
    <script src="data/CanalesdeRiego_3.js"></script>
    <script src="data/Ros_4.js"></script>
    <script src="data/Chacras_5.js"></script>
    <script src="data/Compuertas_6.js"></script>
    <script>
        var map = L.map('map', {
            zoomControl:true, maxZoom:28, minZoom:1
        }).fitBounds([[-12.177132013029917,-75.14802210876465],[-12.166786497041462,-75.12806162590303]]);
        var hash = new L.Hash(map);
        map.attributionControl.setPrefix('<a href="https://github.com/tomchadwin/qgis2web" target="_blank">qgis2web</a> &middot; <a href="https://leafletjs.com" title="A JS library for interactive maps">Leaflet</a> &middot; <a href="https://qgis.org">QGIS</a>');
        var autolinker = new Autolinker({truncate: {length: 30, location: 'smart'}});
        var bounds_group = new L.featureGroup([]);
        function setBounds() {
        }
        map.createPane('pane_OpenStreetMap_0');
        map.getPane('pane_OpenStreetMap_0').style.zIndex = 400;
        var layer_OpenStreetMap_0 = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            pane: 'pane_OpenStreetMap_0',
            opacity: 1.0,
            attribution: '',
            minZoom: 1,
            maxZoom: 28,
            minNativeZoom: 0,
            maxNativeZoom: 19
        });
        layer_OpenStreetMap_0;
        map.addLayer(layer_OpenStreetMap_0);
        map.createPane('pane_GooglecnSatellite_1');
        map.getPane('pane_GooglecnSatellite_1').style.zIndex = 401;
        var layer_GooglecnSatellite_1 = L.tileLayer('http://www.google.cn/maps/vt?lyrs=s@189&gl=cn&x={x}&y={y}&z={z}', {
            pane: 'pane_GooglecnSatellite_1',
            opacity: 1.0,
            attribution: '<a href="https://www.google.com/intl/zh-CN_cn/permissions/geoguidelines/attr-guide.html">地图数据 ©2016 Google</a>',
            minZoom: 1,
            maxZoom: 28,
            minNativeZoom: 0,
            maxNativeZoom: 21
        });
        layer_GooglecnSatellite_1;
        map.addLayer(layer_GooglecnSatellite_1);
        function pop_Zonas_2(feature, layer) {
            var popupContent = '<table>\
                    <tr>\
                        <th scope="row">id</th>\
                        <td>' + (feature.properties['id'] !== null ? autolinker.link(feature.properties['id'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Nombre_zon</th>\
                        <td>' + (feature.properties['Nombre_zon'] !== null ? autolinker.link(feature.properties['Nombre_zon'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">area_km</th>\
                        <td>' + (feature.properties['area_km'] !== null ? autolinker.link(feature.properties['area_km'].toLocaleString()) : '') + '</td>\
                    </tr>\
                </table>';
            layer.bindPopup(popupContent, {maxHeight: 400});
        }

        function style_Zonas_2_0() {
            return {
                pane: 'pane_Zonas_2',
                opacity: 1,
                color: 'rgba(228,26,28,1.0)',
                dashArray: '',
                lineCap: 'square',
                lineJoin: 'bevel',
                weight: 4.0,
                fillOpacity: 0,
                interactive: true,
            }
        }
        map.createPane('pane_Zonas_2');
        map.getPane('pane_Zonas_2').style.zIndex = 402;
        map.getPane('pane_Zonas_2').style['mix-blend-mode'] = 'normal';
        var layer_Zonas_2 = new L.geoJson(json_Zonas_2, {
            attribution: '',
            interactive: true,
            dataVar: 'json_Zonas_2',
            layerName: 'layer_Zonas_2',
            pane: 'pane_Zonas_2',
            onEachFeature: pop_Zonas_2,
            style: style_Zonas_2_0,
        });
        bounds_group.addLayer(layer_Zonas_2);
        map.addLayer(layer_Zonas_2);
        function pop_CanalesdeRiego_3(feature, layer) {
            var popupContent = '<table>\
                    <tr>\
                        <th scope="row">id</th>\
                        <td>' + (feature.properties['id'] !== null ? autolinker.link(feature.properties['id'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Nombre</th>\
                        <td>' + (feature.properties['Nombre'] !== null ? autolinker.link(feature.properties['Nombre'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Longitud</th>\
                        <td>' + (feature.properties['Longitud'] !== null ? autolinker.link(feature.properties['Longitud'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Zona</th>\
                        <td>' + (feature.properties['Zona'] !== null ? autolinker.link(feature.properties['Zona'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">imagen</th>\
                        <td>' + (feature.properties['imagen'] !== null ? '<img src="images/' + String(feature.properties['imagen']).replace(/[\\\/:]/g, '_').trim() + '">' : '') + '</td>\
                    </tr>\
                </table>';
            layer.bindPopup(popupContent, {maxHeight: 400});
        }

        function style_CanalesdeRiego_3_0() {
            return {
                pane: 'pane_CanalesdeRiego_3',
                opacity: 1,
                color: 'rgba(121,174,229,1.0)',
                dashArray: '',
                lineCap: 'round',
                lineJoin: 'round',
                weight: 3.0,
                fillOpacity: 0,
                interactive: true,
            }
        }
        map.createPane('pane_CanalesdeRiego_3');
        map.getPane('pane_CanalesdeRiego_3').style.zIndex = 403;
        map.getPane('pane_CanalesdeRiego_3').style['mix-blend-mode'] = 'normal';
        var layer_CanalesdeRiego_3 = new L.geoJson(json_CanalesdeRiego_3, {
            attribution: '',
            interactive: true,
            dataVar: 'json_CanalesdeRiego_3',
            layerName: 'layer_CanalesdeRiego_3',
            pane: 'pane_CanalesdeRiego_3',
            onEachFeature: pop_CanalesdeRiego_3,
            style: style_CanalesdeRiego_3_0,
        });
        bounds_group.addLayer(layer_CanalesdeRiego_3);
        map.addLayer(layer_CanalesdeRiego_3);
        function pop_Ros_4(feature, layer) {
            var popupContent = '<table>\
                    <tr>\
                        <th scope="row">id</th>\
                        <td>' + (feature.properties['id'] !== null ? autolinker.link(feature.properties['id'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">nombre</th>\
                        <td>' + (feature.properties['nombre'] !== null ? autolinker.link(feature.properties['nombre'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <td colspan="2">' + (feature.properties['tipo_rio'] !== null ? autolinker.link(feature.properties['tipo_rio'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">longitud_m</th>\
                        <td>' + (feature.properties['longitud_m'] !== null ? autolinker.link(feature.properties['longitud_m'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">imagen</th>\
                        <td>' + (feature.properties['imagen'] !== null ? '<img src="images/' + String(feature.properties['imagen']).replace(/[\\\/:]/g, '_').trim() + '">' : '') + '</td>\
                    </tr>\
                </table>';
            layer.bindPopup(popupContent, {maxHeight: 400});
        }

        function style_Ros_4_0() {
            return {
                pane: 'pane_Ros_4',
                opacity: 1,
                color: 'rgba(23,215,206,1.0)',
                dashArray: '',
                lineCap: 'square',
                lineJoin: 'round',
                weight: 4.0,
                fillOpacity: 0,
                interactive: true,
            }
        }
        function style_Ros_4_1() {
            return {
                pane: 'pane_Ros_4',
                opacity: 1,
                color: 'rgba(23,215,206,1.0)',
                dashArray: '',
                lineCap: 'square',
                lineJoin: 'bevel',
                weight: 4.0,
                fillOpacity: 0,
                interactive: true,
            }
        }
        function style_Ros_4_2() {
            return {
                pane: 'pane_Ros_4',
                interactive: true,
            }
        }
        map.createPane('pane_Ros_4');
        map.getPane('pane_Ros_4').style.zIndex = 404;
        map.getPane('pane_Ros_4').style['mix-blend-mode'] = 'normal';
        var layer_Ros_4 = new L.geoJson.multiStyle(json_Ros_4, {
            attribution: '',
            interactive: true,
            dataVar: 'json_Ros_4',
            layerName: 'layer_Ros_4',
            pane: 'pane_Ros_4',
            onEachFeature: pop_Ros_4,
            styles: [style_Ros_4_0,style_Ros_4_1,style_Ros_4_2,]
        });
        bounds_group.addLayer(layer_Ros_4);
        map.addLayer(layer_Ros_4);
        function pop_Chacras_5(feature, layer) {
            var popupContent = '<table>\
                    <tr>\
                        <th scope="row">id</th>\
                        <td>' + (feature.properties['id'] !== null ? autolinker.link(feature.properties['id'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">nombre</th>\
                        <td>' + (feature.properties['nombre'] !== null ? autolinker.link(feature.properties['nombre'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">area_km2</th>\
                        <td>' + (feature.properties['area_km2'] !== null ? autolinker.link(feature.properties['area_km2'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">tipo_cutiv</th>\
                        <td>' + (feature.properties['tipo_cutiv'] !== null ? autolinker.link(feature.properties['tipo_cutiv'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">zona</th>\
                        <td>' + (feature.properties['zona'] !== null ? autolinker.link(feature.properties['zona'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">imagen</th>\
                        <td>' + (feature.properties['imagen'] !== null ? '<img src="images/' + String(feature.properties['imagen']).replace(/[\\\/:]/g, '_').trim() + '">' : '') + '</td>\
                    </tr>\
                </table>';
            layer.bindPopup(popupContent, {maxHeight: 400});
        }

        var pattern_Chacras_5_0 = new L.StripePattern({
            weight: 0.3,
            spaceWeight: 2.0,
            color: '#4daf4a',
            opacity: 1.0,
            spaceOpacity: 0,
            angle: 315
        });
        pattern_Chacras_5_0.addTo(map);
        function style_Chacras_5_0() {
            return {
                pane: 'pane_Chacras_5',
                stroke: false,
                fillOpacity: 1,
                fillPattern: pattern_Chacras_5_0,
                interactive: true,
            }
        }
        function style_Chacras_5_1() {
            return {
                pane: 'pane_Chacras_5',
                opacity: 1,
                color: 'rgba(77,175,74,1.0)',
                dashArray: '',
                lineCap: 'square',
                lineJoin: 'bevel',
                weight: 2.0,
                fillOpacity: 0,
                interactive: true,
            }
        }
        map.createPane('pane_Chacras_5');
        map.getPane('pane_Chacras_5').style.zIndex = 405;
        map.getPane('pane_Chacras_5').style['mix-blend-mode'] = 'normal';
        var layer_Chacras_5 = new L.geoJson.multiStyle(json_Chacras_5, {
            attribution: '',
            interactive: true,
            dataVar: 'json_Chacras_5',
            layerName: 'layer_Chacras_5',
            pane: 'pane_Chacras_5',
            onEachFeature: pop_Chacras_5,
            styles: [style_Chacras_5_0,style_Chacras_5_1,]
        });
        bounds_group.addLayer(layer_Chacras_5);
        map.addLayer(layer_Chacras_5);
        function pop_Compuertas_6(feature, layer) {
            var popupContent = '<table>\
                    <tr>\
                        <th scope="row">id</th>\
                        <td>' + (feature.properties['id'] !== null ? autolinker.link(feature.properties['id'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Nombre</th>\
                        <td>' + (feature.properties['Nombre'] !== null ? autolinker.link(feature.properties['Nombre'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <td colspan="2">' + (feature.properties['Horario'] !== null ? autolinker.link(feature.properties['Horario'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <td colspan="2">' + (feature.properties['Dias'] !== null ? autolinker.link(feature.properties['Dias'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Zona</th>\
                        <td>' + (feature.properties['Zona'] !== null ? autolinker.link(feature.properties['Zona'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <td colspan="2">' + (feature.properties['UTMX'] !== null ? autolinker.link(feature.properties['UTMX'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <td colspan="2">' + (feature.properties['UTMY'] !== null ? autolinker.link(feature.properties['UTMY'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">imagen</th>\
                        <td>' + (feature.properties['imagen'] !== null ? '<img src="images/' + String(feature.properties['imagen']).replace(/[\\\/:]/g, '_').trim() + '">' : '') + '</td>\
                    </tr>\
                </table>';
            layer.bindPopup(popupContent, {maxHeight: 400});
        }

        function style_Compuertas_6_0() {
            return {
                pane: 'pane_Compuertas_6',
                radius: 8.0,
                opacity: 1,
                color: 'rgba(128,67,36,1.0)',
                dashArray: '',
                lineCap: 'butt',
                lineJoin: 'miter',
                weight: 2.0,
                fill: true,
                fillOpacity: 1,
                fillColor: 'rgba(172,91,49,1.0)',
                interactive: true,
            }
        }
        map.createPane('pane_Compuertas_6');
        map.getPane('pane_Compuertas_6').style.zIndex = 406;
        map.getPane('pane_Compuertas_6').style['mix-blend-mode'] = 'normal';
        var layer_Compuertas_6 = new L.geoJson(json_Compuertas_6, {
            attribution: '',
            interactive: true,
            dataVar: 'json_Compuertas_6',
            layerName: 'layer_Compuertas_6',
            pane: 'pane_Compuertas_6',
            onEachFeature: pop_Compuertas_6,
            pointToLayer: function (feature, latlng) {
                var context = {
                    feature: feature,
                    variables: {}
                };
                return L.circleMarker(latlng, style_Compuertas_6_0(feature));
            },
        });
        bounds_group.addLayer(layer_Compuertas_6);
        map.addLayer(layer_Compuertas_6);
        setBounds();
        var i = 0;
        layer_Zonas_2.eachLayer(function(layer) {
            var context = {
                feature: layer.feature,
                variables: {}
            };
            layer.bindTooltip((layer.feature.properties['Nombre_zon'] !== null?String('<div style="color: #ff0101; font-size: 14pt; font-weight: bold; font-family: \'Nirmala UI\', sans-serif;">' + layer.feature.properties['Nombre_zon']) + '</div>':''), {permanent: true, offset: [-0, -16], className: 'css_Zonas_2'});
            labels.push(layer);
            totalMarkers += 1;
              layer.added = true;
              addLabel(layer, i);
              i++;
        });
        var i = 0;
        layer_Ros_4.eachLayer(function(layer) {
            var context = {
                feature: layer.feature,
                variables: {}
            };
            layer.bindTooltip((layer.feature.properties['nombre'] !== null?String('<div style="color: #65f7f9; font-size: 14pt; font-weight: bold; font-family: \'Source Sans Pro Black\', sans-serif;">' + layer.feature.properties['nombre']) + '</div>':''), {permanent: true, offset: [-0, -16], className: 'css_Ros_4'});
            labels.push(layer);
            totalMarkers += 1;
              layer.added = true;
              addLabel(layer, i);
              i++;
        });
        resetLabels([layer_Zonas_2,layer_Ros_4]);
        map.on("zoomend", function(){
            resetLabels([layer_Zonas_2,layer_Ros_4]);
        });
        map.on("layeradd", function(){
            resetLabels([layer_Zonas_2,layer_Ros_4]);
        });
        map.on("layerremove", function(){
            resetLabels([layer_Zonas_2,layer_Ros_4]);
        });
  </script>
</body>

</html>