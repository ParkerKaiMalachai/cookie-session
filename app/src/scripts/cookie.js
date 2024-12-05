let sendBtn = document.querySelector(".cookie-create-btn");

sendBtn.addEventListener("click", async (e) => {
  e.preventDefault();

  let name = e.target
    .closest("form")
    .querySelector(".cookie-create-name").value;
  let value = e.target
    .closest("form")
    .querySelector(".cookie-create-value").value;
  let expire = e.target
    .closest("form")
    .querySelector(".cookie-create-expire").value;
  let action = "setCookie";

  try {
    const response = await fetch("tasks/cookie.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: new URLSearchParams({ name, value, expire, action }),
    });
  } catch (e) {}

  setTimeout(() => {
    window.location.reload();
  }, 1000);
});

window.addEventListener("click", async (e) => {
  if (e.target.classList.contains("cookie-delete-btn")) {
    e.preventDefault();

    let name = e.target.closest("li").querySelector("p").innerText;
    let action = "removeCookie";
    try {
      const response = await fetch("tasks/cookie.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams({ name, action }),
      });
    } catch (e) {}

    setTimeout(() => {
      window.location.reload();
    }, 1000);
  }
});
