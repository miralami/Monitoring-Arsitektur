// Indonesia GeoJSON map data for ECharts
// This is a simplified version for demonstration
(function (root, factory) {
    if (typeof define === 'function' && define.amd) {
        define(['exports', 'echarts'], factory);
    } else if (typeof exports === 'object' && typeof exports.nodeName !== 'string') {
        factory(exports, require('echarts'));
    } else {
        factory({}, root.echarts);
    }
}(this, function (exports, echarts) {
    var map = {
        "type": "FeatureCollection",
        "features": [
            {
                "type": "Feature",
                "properties": {"name": "DKI Jakarta"},
                "geometry": {
                    "type": "Polygon",
                    "coordinates": [/* Coordinates would go here */]
                }
            },
            // Additional provinces would be defined here
        ]
    };

    echarts.registerMap('Indonesia', map);
}));
