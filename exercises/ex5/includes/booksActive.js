function showData(data) {

	const ulFrag = document.createDocumentFragment();
	for (const key in data.catagory) {
		const li = document.createElement('li');
		sHtml = `<a class="dropdown-item" href='index.php?category="${data.catagory[key]}"'>${data.catagory[key]}</a>`;
		li.innerHTML = sHtml;
		ulFrag.appendChild(li);
	}
	document.getElementById("dropmenu").appendChild(ulFrag);

}

fetch("data/catagory.json")
	.then(response => response.json())
	.then(data => showData(data));
