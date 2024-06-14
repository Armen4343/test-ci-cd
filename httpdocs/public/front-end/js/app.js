var db = new loki("csc.db");

const countriesJSON =
  "https://raw.githubusercontent.com/dr5hn/countries-states-cities-database/master/countries.json";
const statesJSON =
  "https://raw.githubusercontent.com/dr5hn/countries-states-cities-database/master/states.json";
const citiesJSON =
  "https://raw.githubusercontent.com/dr5hn/countries-states-cities-database/master/cities.json";

async function initializeData() {
  var countries = db.getCollection("countries");
  if (!countries) {
    countries = db.addCollection("countries");
    await fetch(countriesJSON)
      .then((response) => response.json())
      .then(async (data) => {
        await data.forEach((c) => {
          countries.insert(c);
        });
        $(".countries-tb").html(
          `<tr> <td class="border px-4 py-2">United States - US</td></tr>`
        );
      });
  }

  var states = db.getCollection("states");
  if (!states) {
    states = db.addCollection("states");
    await fetch(statesJSON)
      .then((response) => response.json())
      .then(async (data) => {
        await data.forEach((d) => {
          states.insert(d);
        });
      });
  }

  var cities = db.getCollection("cities");
  if (!cities) {
    cities = db.addCollection("cities");
    await fetch(citiesJSON)
      .then((response) => response.json())
      .then(async (data) => {
        await data.forEach((d) => {
          cities.insert(d);
        });
      });
  }
}

initializeData();

async function filterCities($sid = null) {
  $sid = $sid.querySelector(":checked").getAttribute("data-id");
  let citiesColl = db.getCollection("cities");
  let cities = await citiesColl.find({ state_id: parseInt($sid) });
  let $cities = $(".cities-tb");
  $cities.html("");
  if (cities.length) {
    await cities.forEach((c) => {
      $cities.append(`
      <option value="${c.name}">${c.name}</option>
      `);
    });
  } else {
    $cities.append(`
      <option value="No Cities Found.">No Cities Found.</option>
      `);
  }
}
