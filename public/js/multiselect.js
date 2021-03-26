function checkFiles(image) {
    if(image.length > 5) {
        alert("Select a maximum of 5 images!");

        let list = new DataTransfer;
        for(let i=0; i<5; i++)
            list.items.add(image[i])

        document.getElementById('image').image = list.image
    }
}
