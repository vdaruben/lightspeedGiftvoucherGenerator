// loop over svg nodes and generate barcodes
var svgNodes = document.querySelectorAll('svg');
for (let i = 0; i < svgNodes.length; i++) {
  var serialnumber = svgNodes[i].getAttribute('serialnumber');
  JsBarcode("#barcode" + i, serialnumber, {
    width: 1,
    height:20,
    fontSize: 10
  });
}