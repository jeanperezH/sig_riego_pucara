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
        <script src="js/leaflet-control-geocoder.Geocoder.js"></script>
        <script src="js/leaflet-search.js"></script>
        <script src="data/Zonas_1.js"></script>
        <script src="data/Rios_2.js"></script>
        <script src="data/CanalesdeRiego_3.js"></script>
        <script src="data/Compuertas_4.js"></script>
        <script src="data/Chacras_5.js"></script>
        <script>
        var map = L.map('map', {
            zoomControl:true, maxZoom:28, minZoom:1
        })
        var hash = new L.Hash(map);
        map.attributionControl.setPrefix('<a href="https://github.com/tomchadwin/qgis2web" target="_blank">qgis2web</a> &middot; <a href="https://leafletjs.com" title="A JS library for interactive maps">Leaflet</a> &middot; <a href="https://qgis.org">QGIS</a>');
        var autolinker = new Autolinker({truncate: {length: 30, location: 'smart'}});
        var bounds_group = new L.featureGroup([]);
        function setBounds() {
            if (bounds_group.getLayers().length) {
                map.fitBounds(bounds_group.getBounds());
            }
        }
        map.createPane('pane_GoogleSatellite_0');
        map.getPane('pane_GoogleSatellite_0').style.zIndex = 400;
        var layer_GoogleSatellite_0 = L.tileLayer('http://www.google.cn/maps/vt?lyrs=s@189&gl=cn&x={x}&y={y}&z={z}', {
            pane: 'pane_GoogleSatellite_0',
            opacity: 1.0,
            attribution: '<a href="https://www.google.com/intl/zh-CN_cn/permissions/geoguidelines/attr-guide.html">地图数据 ©2016 Google</a>',
            minZoom: 1,
            maxZoom: 28,
            minNativeZoom: 0,
            maxNativeZoom: 21
        });
        layer_GoogleSatellite_0;
        map.addLayer(layer_GoogleSatellite_0);
        function pop_Zonas_1(feature, layer) {
            var popupContent = '<table>\
                    <tr>\
                        <th scope="row">id</th>\
                        <td>' + (feature.properties['id'] !== null ? autolinker.link(feature.properties['id'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Nombre_Zon</th>\
                        <td>' + (feature.properties['Nombre_Zon'] !== null ? autolinker.link(feature.properties['Nombre_Zon'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Area_km2</th>\
                        <td>' + (feature.properties['Area_km2'] !== null ? autolinker.link(feature.properties['Area_km2'].toLocaleString()) : '') + '</td>\
                    </tr>\
                </table>';
            layer.bindPopup(popupContent, {maxHeight: 400});
        }

        function style_Zonas_1_0(feature) {
            switch(String(feature.properties['Nombre_Zon'])) {
                case 'Zona 1':
                    return {
                pane: 'pane_Zonas_1',
                opacity: 1,
                color: 'rgba(17,150,48,1.0)',
                dashArray: '',
                lineCap: 'square',
                lineJoin: 'bevel',
                weight: 4.0,
                fillOpacity: 0,
                interactive: true,
            }
                    break;
                case 'Zona 2':
                    return {
                pane: 'pane_Zonas_1',
                opacity: 1,
                color: 'rgba(0,209,14,1.0)',
                dashArray: '',
                lineCap: 'square',
                lineJoin: 'bevel',
                weight: 4.0,
                fillOpacity: 0,
                interactive: true,
            }
                    break;
                case 'Zona 3':
                    return {
                pane: 'pane_Zonas_1',
                opacity: 1,
                color: 'rgba(199,204,35,1.0)',
                dashArray: '',
                lineCap: 'square',
                lineJoin: 'bevel',
                weight: 4.0,
                fillOpacity: 0,
                interactive: true,
            }
                    break;
            }
        }
        map.createPane('pane_Zonas_1');
        map.getPane('pane_Zonas_1').style.zIndex = 401;
        map.getPane('pane_Zonas_1').style['mix-blend-mode'] = 'normal';
        var layer_Zonas_1 = new L.geoJson(json_Zonas_1, {
            attribution: '',
            interactive: true,
            dataVar: 'json_Zonas_1',
            layerName: 'layer_Zonas_1',
            pane: 'pane_Zonas_1',
            onEachFeature: pop_Zonas_1,
            style: style_Zonas_1_0,
        });
        bounds_group.addLayer(layer_Zonas_1);
        map.addLayer(layer_Zonas_1);
        function pop_Rios_2(feature, layer) {
            var popupContent = '<table>\
                    <tr>\
                        <th scope="row">id</th>\
                        <td>' + (feature.properties['id'] !== null ? autolinker.link(feature.properties['id'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Nombre_Rio</th>\
                        <td>' + (feature.properties['Nombre_Rio'] !== null ? autolinker.link(feature.properties['Nombre_Rio'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Tipo_Rio</th>\
                        <td>' + (feature.properties['Tipo_Rio'] !== null ? autolinker.link(feature.properties['Tipo_Rio'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Longitud_m</th>\
                        <td>' + (feature.properties['Longitud_m'] !== null ? autolinker.link(feature.properties['Longitud_m'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Imagen</th>\
                        <td>' + (feature.properties['Imagen'] !== null ? '<img src="images/' + String(feature.properties['Imagen']).replace(/[\\\/:]/g, '_').trim() + '">' : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Zona</th>\
                        <td>' + (feature.properties['Zona'] !== null ? autolinker.link(feature.properties['Zona'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <td colspan="2">' + (feature.properties['auxiliary_storage_labeling_positionx'] !== null ? autolinker.link(feature.properties['auxiliary_storage_labeling_positionx'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <td colspan="2">' + (feature.properties['auxiliary_storage_labeling_positiony'] !== null ? autolinker.link(feature.properties['auxiliary_storage_labeling_positiony'].toLocaleString()) : '') + '</td>\
                    </tr>\
                </table>';
            layer.bindPopup(popupContent, {maxHeight: 400});
        }

        function style_Rios_2_0(feature) {
            switch(String(feature.properties['zona'])) {
                case '1':
                    return {
                pane: 'pane_Rios_2',
                opacity: 1,
                color: 'rgba(0,246,250,1.0)',
                dashArray: '',
                lineCap: 'square',
                lineJoin: 'round',
                weight: 3.0,
                fillOpacity: 0,
                interactive: true,
            }
                    break;
                case '2':
                    return {
                pane: 'pane_Rios_2',
                opacity: 1,
                color: 'rgba(0,246,250,1.0)',
                dashArray: '',
                lineCap: 'square',
                lineJoin: 'round',
                weight: 3.0,
                fillOpacity: 0,
                interactive: true,
            }
                    break;
                case '3':
                    return {
                pane: 'pane_Rios_2',
                opacity: 1,
                color: 'rgba(0,246,250,1.0)',
                dashArray: '',
                lineCap: 'square',
                lineJoin: 'round',
                weight: 3.0,
                fillOpacity: 0,
                interactive: true,
            }
                    break;
            }
        }
        function style_Rios_2_1(feature) {
            switch(String(feature.properties['zona'])) {
                case '1':
                    return {
                pane: 'pane_Rios_2',
                opacity: 1,
                color: 'rgba(0,246,250,1.0)',
                dashArray: '',
                lineCap: 'square',
                lineJoin: 'bevel',
                weight: 3.0,
                fillOpacity: 0,
                interactive: true,
            }
                    break;
                case '2':
                    return {
                pane: 'pane_Rios_2',
                opacity: 1,
                color: 'rgba(0,246,250,1.0)',
                dashArray: '',
                lineCap: 'square',
                lineJoin: 'bevel',
                weight: 3.0,
                fillOpacity: 0,
                interactive: true,
            }
                    break;
                case '3':
                    return {
                pane: 'pane_Rios_2',
                opacity: 1,
                color: 'rgba(0,246,250,1.0)',
                dashArray: '',
                lineCap: 'square',
                lineJoin: 'bevel',
                weight: 3.0,
                fillOpacity: 0,
                interactive: true,
            }
                    break;
            }
        }
        function style_Rios_2_2(feature) {
            switch(String(feature.properties['zona'])) {
                case '1':
                    return {
                pane: 'pane_Rios_2',
                interactive: true,
            }
                    break;
                case '2':
                    return {
                pane: 'pane_Rios_2',
                interactive: true,
            }
                    break;
                case '3':
                    return {
                pane: 'pane_Rios_2',
                interactive: true,
            }
                    break;
            }
        }
        map.createPane('pane_Rios_2');
        map.getPane('pane_Rios_2').style.zIndex = 402;
        map.getPane('pane_Rios_2').style['mix-blend-mode'] = 'normal';
        var layer_Rios_2 = new L.geoJson.multiStyle(json_Rios_2, {
            attribution: '',
            interactive: true,
            dataVar: 'json_Rios_2',
            layerName: 'layer_Rios_2',
            pane: 'pane_Rios_2',
            onEachFeature: pop_Rios_2,
            styles: [style_Rios_2_0,style_Rios_2_1,style_Rios_2_2,]
        });
        bounds_group.addLayer(layer_Rios_2);
        map.addLayer(layer_Rios_2);
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
                        <th scope="row">Imagen</th>\
                        <td>' + (feature.properties['Imagen'] !== null ? '<img src="images/' + String(feature.properties['Imagen']).replace(/[\\\/:]/g, '_').trim() + '">' : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Valvula_In</th>\
                        <td>' + (feature.properties['Valvula_In'] !== null ? autolinker.link(feature.properties['Valvula_In'].toLocaleString()) : '') + '</td>\
                    </tr>\
                </table>';
            layer.bindPopup(popupContent, {maxHeight: 400});
        }

        function style_CanalesdeRiego_3_0(feature) {
            switch(String(feature.properties['Zona'])) {
                case '1':
                    return {
                pane: 'pane_CanalesdeRiego_3',
                opacity: 1,
                color: 'rgba(31,120,180,1.0)',
                dashArray: '',
                lineCap: 'round',
                lineJoin: 'round',
                weight: 3.0,
                fillOpacity: 0,
                interactive: true,
            }
                    break;
                case '2':
                    return {
                pane: 'pane_CanalesdeRiego_3',
                opacity: 1,
                color: 'rgba(31,120,180,1.0)',
                dashArray: '',
                lineCap: 'round',
                lineJoin: 'round',
                weight: 3.0,
                fillOpacity: 0,
                interactive: true,
            }
                    break;
                case '3':
                    return {
                pane: 'pane_CanalesdeRiego_3',
                opacity: 1,
                color: 'rgba(31,120,180,1.0)',
                dashArray: '',
                lineCap: 'round',
                lineJoin: 'round',
                weight: 3.0,
                fillOpacity: 0,
                interactive: true,
            }
                    break;
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
        function pop_Compuertas_4(feature, layer) {
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
                        <th scope="row">Zona</th>\
                        <td>' + (feature.properties['Zona'] !== null ? autolinker.link(feature.properties['Zona'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">UTMX</th>\
                        <td>' + (feature.properties['UTMX'] !== null ? autolinker.link(feature.properties['UTMX'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">UTMY</th>\
                        <td>' + (feature.properties['UTMY'] !== null ? autolinker.link(feature.properties['UTMY'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Imagen</th>\
                        <td>' + (feature.properties['Imagen'] !== null ? '<img src="images/' + String(feature.properties['Imagen']).replace(/[\\\/:]/g, '_').trim() + '">' : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Hora_Inici</th>\
                        <td>' + (feature.properties['Hora_Inici'] !== null ? autolinker.link(feature.properties['Hora_Inici'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Hora_Final</th>\
                        <td>' + (feature.properties['Hora_Final'] !== null ? autolinker.link(feature.properties['Hora_Final'].toLocaleString()) : '') + '</td>\
                    </tr>\
                </table>';
            layer.bindPopup(popupContent, {maxHeight: 400});
        }

        function style_Compuertas_4_0(feature) {
            switch(String(feature.properties['Zona'])) {
                case '1':
                    return {
                pane: 'pane_Compuertas_4',
        rotationAngle: 0.0,
        rotationOrigin: 'center center',
        icon: L.icon({
            iconUrl: 'markers/valvula.svg',
            iconSize: [22.799999999999997, 22.799999999999997]
        }),
                interactive: true,
            }
                    break;
                case '2':
                    return {
                pane: 'pane_Compuertas_4',
        rotationAngle: 0.0,
        rotationOrigin: 'center center',
        icon: L.icon({
            iconUrl: 'markers/valvula.svg',
            iconSize: [22.799999999999997, 22.799999999999997]
        }),
                interactive: true,
            }
                    break;
                case '3':
                    return {
                pane: 'pane_Compuertas_4',
        rotationAngle: 0.0,
        rotationOrigin: 'center center',
        icon: L.icon({
            iconUrl: 'markers/valvula.svg',
            iconSize: [22.799999999999997, 22.799999999999997]
        }),
                interactive: true,
            }
                    break;
            }
        }
        map.createPane('pane_Compuertas_4');
        map.getPane('pane_Compuertas_4').style.zIndex = 404;
        map.getPane('pane_Compuertas_4').style['mix-blend-mode'] = 'normal';
        var layer_Compuertas_4 = new L.geoJson(json_Compuertas_4, {
            attribution: '',
            interactive: true,
            dataVar: 'json_Compuertas_4',
            layerName: 'layer_Compuertas_4',
            pane: 'pane_Compuertas_4',
            onEachFeature: pop_Compuertas_4,
            pointToLayer: function (feature, latlng) {
                var context = {
                    feature: feature,
                    variables: {}
                };
                return L.marker(latlng, style_Compuertas_4_0(feature));
            },
        });
        bounds_group.addLayer(layer_Compuertas_4);
        map.addLayer(layer_Compuertas_4);
        function pop_Chacras_5(feature, layer) {
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
                        <th scope="row">Area_km2</th>\
                        <td>' + (feature.properties['Area_km2'] !== null ? autolinker.link(feature.properties['Area_km2'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Tipo_Cutiv</th>\
                        <td>' + (feature.properties['Tipo_Cutiv'] !== null ? autolinker.link(feature.properties['Tipo_Cutiv'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Zona</th>\
                        <td>' + (feature.properties['Zona'] !== null ? autolinker.link(feature.properties['Zona'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Imagen</th>\
                        <td>' + (feature.properties['Imagen'] !== null ? '<img src="images/' + String(feature.properties['Imagen']).replace(/[\\\/:]/g, '_').trim() + '">' : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Nombre_Usu</th>\
                        <td>' + (feature.properties['Nombre_Usu'] !== null ? autolinker.link(feature.properties['Nombre_Usu'].toLocaleString()) : '') + '</td>\
                    </tr>\
                </table>';
            layer.bindPopup(popupContent, {maxHeight: 400});
        }

        var pattern_Chacras_5_0 = new L.StripePattern({
            weight: 0.3,
            spaceWeight: 2.0,
            color: '#119630',
            opacity: 1.0,
            spaceOpacity: 0,
            angle: 315
        });
        pattern_Chacras_5_0.addTo(map);
        var pattern_Chacras_5_0 = new L.StripePattern({
            weight: 0.3,
            spaceWeight: 2.0,
            color: '#00d10e',
            opacity: 1.0,
            spaceOpacity: 0,
            angle: 315
        });
        pattern_Chacras_5_0.addTo(map);
        var pattern_Chacras_5_0 = new L.StripePattern({
            weight: 0.3,
            spaceWeight: 2.0,
            color: '#c7cc23',
            opacity: 1.0,
            spaceOpacity: 0,
            angle: 315
        });
        pattern_Chacras_5_0.addTo(map);
        var pattern_Chacras_5_0 = new L.StripePattern({
            weight: 0.3,
            spaceWeight: 2.0,
            color: '#119630',
            opacity: 1.0,
            spaceOpacity: 0,
            angle: 315
        });
        pattern_Chacras_5_0.addTo(map);
        var pattern_Chacras_5_0 = new L.StripePattern({
            weight: 0.3,
            spaceWeight: 2.0,
            color: '#00d10e',
            opacity: 1.0,
            spaceOpacity: 0,
            angle: 315
        });
        pattern_Chacras_5_0.addTo(map);
        var pattern_Chacras_5_0 = new L.StripePattern({
            weight: 0.3,
            spaceWeight: 2.0,
            color: '#c7cc23',
            opacity: 1.0,
            spaceOpacity: 0,
            angle: 315
        });
        pattern_Chacras_5_0.addTo(map);
        function style_Chacras_5_0(feature) {
            switch(String(feature.properties['Zona'])) {
                case '1':
                    return {
                pane: 'pane_Chacras_5',
                stroke: false,
                fillOpacity: 1,
                fillPattern: pattern_Chacras_5_0,
                interactive: true,
            }
                    break;
                case '2':
                    return {
                pane: 'pane_Chacras_5',
                stroke: false,
                fillOpacity: 1,
                fillPattern: pattern_Chacras_5_0,
                interactive: true,
            }
                    break;
                case '3':
                    return {
                pane: 'pane_Chacras_5',
                stroke: false,
                fillOpacity: 1,
                fillPattern: pattern_Chacras_5_0,
                interactive: true,
            }
                    break;
            }
        }
        function style_Chacras_5_1(feature) {
            switch(String(feature.properties['Zona'])) {
                case '1':
                    return {
                pane: 'pane_Chacras_5',
                opacity: 1,
                color: 'rgba(17,150,48,1.0)',
                dashArray: '',
                lineCap: 'square',
                lineJoin: 'bevel',
                weight: 2.0,
                fillOpacity: 0,
                interactive: true,
            }
                    break;
                case '2':
                    return {
                pane: 'pane_Chacras_5',
                opacity: 1,
                color: 'rgba(0,209,14,1.0)',
                dashArray: '',
                lineCap: 'square',
                lineJoin: 'bevel',
                weight: 2.0,
                fillOpacity: 0,
                interactive: true,
            }
                    break;
                case '3':
                    return {
                pane: 'pane_Chacras_5',
                opacity: 1,
                color: 'rgba(199,204,35,1.0)',
                dashArray: '',
                lineCap: 'square',
                lineJoin: 'bevel',
                weight: 2.0,
                fillOpacity: 0,
                interactive: true,
            }
                    break;
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
        var osmGeocoder = new L.Control.Geocoder({
            collapsed: true,
            position: 'topleft',
            text: 'Search',
            title: 'Testing'
        }).addTo(map);
        document.getElementsByClassName('leaflet-control-geocoder-icon')[0]
        .className += ' fa fa-search';
        document.getElementsByClassName('leaflet-control-geocoder-icon')[0]
        .title += 'Search for a place';
        var baseMaps = {};
        L.control.layers(baseMaps,{'Chacras<br /><table><tr><td style="text-align: center;"><img src="legend/Chacras_5_Zona10.png" /></td><td>Zona 1</td></tr><tr><td style="text-align: center;"><img src="legend/Chacras_5_Zona21.png" /></td><td>Zona 2</td></tr><tr><td style="text-align: center;"><img src="legend/Chacras_5_Zona32.png" /></td><td>Zona 3</td></tr></table>': layer_Chacras_5,'Compuertas<br /><table><tr><td style="text-align: center;"><img src="legend/Compuertas_4_Zona10.png" /></td><td>Zona 1</td></tr><tr><td style="text-align: center;"><img src="legend/Compuertas_4_Zona21.png" /></td><td>Zona 2</td></tr><tr><td style="text-align: center;"><img src="legend/Compuertas_4_Zona32.png" /></td><td>Zona 3</td></tr></table>': layer_Compuertas_4,'Canales de Riego<br /><table><tr><td style="text-align: center;"><img src="legend/CanalesdeRiego_3_Zona10.png" /></td><td>Zona 1</td></tr><tr><td style="text-align: center;"><img src="legend/CanalesdeRiego_3_Zona21.png" /></td><td>Zona 2</td></tr><tr><td style="text-align: center;"><img src="legend/CanalesdeRiego_3_Zona32.png" /></td><td>Zona 3</td></tr></table>': layer_CanalesdeRiego_3,'Rios<br /><table><tr><td style="text-align: center;"><img src="legend/Rios_2_Zona10.png" /></td><td>Zona 1</td></tr><tr><td style="text-align: center;"><img src="legend/Rios_2_Zona21.png" /></td><td>Zona 2</td></tr><tr><td style="text-align: center;"><img src="legend/Rios_2_Zona32.png" /></td><td>Zona 3</td></tr></table>': layer_Rios_2,'Zonas<br /><table><tr><td style="text-align: center;"><img src="legend/Zonas_1_Zona10.png" /></td><td>Zona 1</td></tr><tr><td style="text-align: center;"><img src="legend/Zonas_1_Zona21.png" /></td><td>Zona 2</td></tr><tr><td style="text-align: center;"><img src="legend/Zonas_1_Zona32.png" /></td><td>Zona 3</td></tr></table>': layer_Zonas_1,"Google Satellite": layer_GoogleSatellite_0,},{collapsed:false}).addTo(map);
        setBounds();
        var i = 0;
        layer_Zonas_1.eachLayer(function(layer) {
            var context = {
                feature: layer.feature,
                variables: {}
            };
            layer.bindTooltip((layer.feature.properties['Nombre_Zon'] !== null?String('<div style="color: #eaf8c9; font-size: 14pt; font-family: \'Montserrat\', sans-serif;">' + layer.feature.properties['Nombre_Zon']) + '</div>':''), {permanent: true, offset: [-0, -16], className: 'css_Zonas_1'});
            labels.push(layer);
            totalMarkers += 1;
              layer.added = true;
              addLabel(layer, i);
              i++;
        });
        var i = 0;
        layer_Rios_2.eachLayer(function(layer) {
            var context = {
                feature: layer.feature,
                variables: {}
            };
            layer.bindTooltip((layer.feature.properties['Nombre_Rio'] !== null?String('<div style="color: #43f7e5; font-size: 14pt; font-family: \'Montserrat\', sans-serif;">' + layer.feature.properties['Nombre_Rio']) + '</div>':''), {permanent: true, offset: [-0, -16], className: 'css_Rios_2'});
            labels.push(layer);
            totalMarkers += 1;
              layer.added = true;
              addLabel(layer, i);
              i++;
        });
        map.addControl(new L.Control.Search({
            layer: layer_Chacras_5,
            initial: false,
            hideMarkerOnCollapse: true,
            propertyName: 'Nombre'}));
        document.getElementsByClassName('search-button')[0].className +=
         ' fa fa-binoculars';
        resetLabels([layer_Zonas_1,layer_Rios_2,layer_CanalesdeRiego_3,layer_Chacras_5]);
        map.on("zoomend", function(){
            resetLabels([layer_Zonas_1,layer_Rios_2,layer_CanalesdeRiego_3,layer_Chacras_5]);
        });
        map.on("layeradd", function(){
            resetLabels([layer_Zonas_1,layer_Rios_2,layer_CanalesdeRiego_3,layer_Chacras_5]);
        });
        map.on("layerremove", function(){
            resetLabels([layer_Zonas_1,layer_Rios_2,layer_CanalesdeRiego_3,layer_Chacras_5]);
        });
        </script>
</body>

</html>