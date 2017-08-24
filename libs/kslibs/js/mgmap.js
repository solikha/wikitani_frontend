/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * This library require Leaflet.js
 */

var model = namespace('Manggu.Map');

model.merge = function(obj1, obj2){
    var obj3 = {};
    for (var attrname in obj1) { obj3[attrname] = obj1[attrname]; }
    for (var attrname in obj2) { obj3[attrname] = obj2[attrname]; }
    return obj3;
}

model.onMarkerClick = function (e){
    console.log(e);
    var m = e.target;
    console.log(m.getPopup()); 
    var data = m.options.data;
    console.log(data);
    var template = $('#'+data.popupname).html();
    var msg = Mustache.render(template, data);
    m.setPopupContent(msg);
}    
model.isFunction = function (functionToCheck) {
    var getType = {};
    return functionToCheck && getType.toString.call(functionToCheck) === '[object Function]';
}

model.createMarkerFromData = function(data, options){
    var voption = this.merge({
        icon: new L.Icon.Default(),
        copydata: false,
        layer: false,
        popupname: '',
        draggable: false,
        click: this.onMarkerClick
    }, options);

    var marker;
    var vicon;
    var result=[]
    for (var i=0; i<data.length; i++){
        var item = data[i];
        var xitem = {}
        if (this.isFunction(voption.icon)){
            vicon = voption.icon(item);
        } else {
            vicon = voption.icon;
        }
        if (item.latitude && item.longitude){
            item['popupname'] = voption.popupname;
            marker = L.marker(L.latLng(item.latitude, item.longitude), 
                { icon: vicon, title: item.nama, data: item, 
                    draggable: voption.draggable});
            marker.on('click', voption.click);
            marker.bindPopup('test');
            //item['marker'] = marker;
            if(voption.layer){
                voption.layer.addLayer(marker);
            }
            if(voption.copydata){
                xitem = item;
                xitem['marker'] = marker;
            } else {
                xitem['marker'] = marker;
            }
        }
        result.push(xitem);
    }
    return result;
}

model.insertMarkers = function(layer, markers){
    
}
model.createMarkers = function(markers, data, xicon, popupname){
    //var markers = L.featureGroup();
    var icon;
    var marker;
    for (var i=0; i<data.length; i++){
        var item = data[i];
        if (this.isFunction(xicon)){
            icon = xicon(item);
        } else {
            icon = xicon;
        }
        if (item.latitude && item.longitude){
            item['popupname'] = popupname;
            marker = L.marker(L.latLng(item.latitude, item.longitude), 
                { icon: icon, title: item.nama, data: item });
            marker.on('click', this.onMarkerClick);
            marker.bindPopup('test');
            markers.addLayer(marker);
            item['marker'] = marker;
        }
        data[i] = item;
    }
    return markers;
}

model.Window = L.Control.extend({
  options: {
    // topright, topleft, bottomleft, bottomright
    position: 'topright',
    classname: 'container-test',
    html: ''
  },
  initialize: function (options) {
    // constructor
    L.Util.setOptions(this, options);
  },
  onAdd: function (map) {
    // happens after added to map
    var container = L.DomUtil.create('div', this.options.classname);

    $(container).html(this.options.html);
    //container.innerHtml ('Percobaan 12345');
    //this.input = L.DomUtil.create('input', 'form-control input-sm', container);
    //this.input.type = 'text';    
    //this.results = container;
    L.DomEvent.disableClickPropagation(container);
    return container;
  },
  onRemove: function (map) {
    // when removed
  },
  submit: function(e){
      L.DomEvent.preventDefault(e);
  }
});
 
model.window = function(id, options) {
  return new this.Window(id, options);
}

L.RotatedMarker = L.Marker.extend({
  options: { angle: 0 },
  _setPos: function(pos) {
    L.Marker.prototype._setPos.call(this, pos);
    if (L.DomUtil.TRANSFORM) {
      // use the CSS transform rule if available
      this._icon.style[L.DomUtil.TRANSFORM] += ' rotate(' + this.options.angle + 'deg)';
    } else if (L.Browser.ie) {
      // fallback for IE6, IE7, IE8
      var rad = this.options.angle * L.LatLng.DEG_TO_RAD,
      costheta = Math.cos(rad),
      sintheta = Math.sin(rad);
      this._icon.style.filter += ' progid:DXImageTransform.Microsoft.Matrix(sizingMethod=\'auto expand\', M11=' +
        costheta + ', M12=' + (-sintheta) + ', M21=' + sintheta + ', M22=' + costheta + ')';
    }
  }
});
L.rotatedMarker = function(pos, options) {
    return new L.RotatedMarker(pos, options);
};




