let drop_area = document.getElementById('file-drop');
console.log(drop_area);

drop_area.addEventListener('change', handleFileDrop);

function handleFileDrop(ev) {
	let img_link = URL.createObjectURL(drop_area.files[0]);
	console.log(img_link);

	let container = document.getElementById('file-input-cnt');
	let img = document.createElement('img');
	img.src = img_link;
	img.style.width = '200px';
	container.appendChild(img);
}