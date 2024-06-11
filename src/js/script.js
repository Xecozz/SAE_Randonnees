let tab = document.getElementById("tab");

tab.addEventListener("change", event => {
    const tabSize = tab.rows.length;
    
    if (event.target.id !== `station${tabSize - 1}`) return;

    let ligne = tab.insertRow();

    let celluleStation = ligne.insertCell();
    let celluleDatePassage = ligne.insertCell();

    celluleStation.innerHTML = document.getElementById("station1").outerHTML;
    celluleStation.children[0].id = `station${tabSize}`;
    celluleStation.children[0].name = `station${tabSize}`;
    celluleDatePassage.innerHTML = `<input type="date" id="date${tabSize}" name="date${tabSize}" size="20" value=""></input>`;
});