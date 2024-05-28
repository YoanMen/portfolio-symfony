document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("#contact-form");
  const submitBut = document.querySelector("#contact_save");

  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    const formData = new FormData(form);

    const r = await fetch("/api/contact", {
      method: "POST",
      body: formData,
    })
      .then(async (response) => {
        const data = await response.json();
        if (data.success) {
          submitBut.classList.add("opacity-60");
          submitBut.classList.remove("hover:opacity-95");
          submitBut.disabled = true;
          messageMailStatut(
            "Your message has been sent and you will be contacted shortly."
          );
        } else {
          messageMailStatut(data.error, true);
        }
      })
      .catch((error) => {
        messageMailStatut(`error : ${error.message}`, true);
      });
  });

  function messageMailStatut(messageText, error = false) {
    let message = form.querySelector(".message-mail-js");

    if (message) message.remove();

    message = document.createElement("div");
    message.className = `message-mail-js text-black  bg-${
      error ? "red" : "green"
    }-200 px-2 py-4 rounded`;
    message.textContent = messageText;

    form.insertAdjacentElement("afterbegin", message);
  }
});
