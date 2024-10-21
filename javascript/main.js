// Haal de serienummerCount uit de quiristring
const urlSearchParams = new URLSearchParams(window.location.search);
const params = Object.fromEntries(urlSearchParams.entries());
var serienummerCount = params.serienummerCount;
console.log('serienummerCount = ' + serienummerCount);

// Onderstaande lijns is om serienummerCount the hard setten tijden dev
serienummerCount = 50; console.log('DEV serienummerCount = ' + serienummerCount);

// Maak array met onbestaande serienummers
var serienummers = new Array();
for (let i = 0; i < serienummerCount; i++) {
  serienummers[i] = generateSerialnumber();
}

// Loop over serienummers en genereer svg node met barcode voor elk serienummer
console.log(serienummers);
for (let i = 0; i < serienummerCount; i++) {
	JsBarcode("#barcode" + i, serienummers[i], {
    width: 1,
    height:20,
    fontSize: 10
  });
}

// generate code
function generateSerialnumber() {
	// hardcoded om 10 cijfers te zijn, dit mogen er max 23 zijn.
	min = Math.ceil(10000012345);
  max = Math.floor(99999999123);
  return getRandomInteger(min,max);
}

function getRandomInteger(min, max) {
  min = Math.ceil(min);
  max = Math.floor(max);

  return Math.floor(Math.random() * (max - min)) + min;
}