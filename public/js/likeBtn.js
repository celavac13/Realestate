let likeBtn = document.getElementById("likeBtn");
likeBtn.addEventListener("click", () => {
  if (likeBtn.classList.contains("liked")) {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        likeBtn.classList.remove("liked");
        document.getElementById("successMsg").textContent = JSON.parse(
          this.response
        ).message;
      }
    };
    xmlhttp.open(
      "GET",
      "remove-favourites/?" +
        `userId=${
          document.getElementById("userId").dataset.value
        }&realestateId=${
          document.getElementById("realestateId").dataset.value
        }`,
      true
    );
    xmlhttp.send();
  } else {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        likeBtn.classList.add("liked");
        document.getElementById("successMsg").textContent = JSON.parse(
          this.response
        ).message;
      }
    };
    xmlhttp.open(
      "GET",
      "add-favourites/?" +
        `userId=${
          document.getElementById("userId").dataset.value
        }&realestateId=${
          document.getElementById("realestateId").dataset.value
        }`,
      true
    );
    xmlhttp.send();
  }
});
