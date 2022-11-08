let likeBtn = document.getElementById("likeBtn");

likeBtn.addEventListener("click", () => {
  if (likeBtn.classList.contains("liked")) {
    likeBtn.classList.remove("liked");
  } else {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200)
        likeBtn.classList.add("liked");
    };
    xmlhttp.open("POST", "app/favourites.php", true);
    xmlhttp.send(
      `userId=${document.getElementById("userId").dataset.value}&realestateId=${
        document.getElementById("realestateId").dataset.value
      }&delete=0`
    );
  }
});
