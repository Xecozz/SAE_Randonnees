let tab = document.getElementById("tab");

tab.addEventListener("keydown", event => {
    const tabSize = tab.rows.length;

    // parseInt(event.target.id.match(/\d+/)) + 1

    if (event.target.id !== `station${tabSize - 1}` || tabSize > 20) return;

    let ligne = tab.insertRow();

    let celluleStation = ligne.insertCell();
    let celluleRegion = ligne.insertCell();
    let celluleDatePassage = ligne.insertCell();

    celluleStation.innerHTML = `<input type="text" id="station${tabSize}" name="station${tabSize}" size="20" value=""></input>`;
    celluleRegion.innerHTML = `<input type="text" id="region${tabSize}" name="region${tabSize}" size="20" value=""></input>`;
    celluleDatePassage.innerHTML = `<input type="date" id="date${tabSize}" name="date${tabSize}" size="20" value=""></input>`;
});