document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("#contact-form");

  const name = form.querySelector("#contact_name");
  const email = form.querySelector("#contact_email");
  const message = form.querySelector("#contact_message");

  const submitBut = document.querySelector("#contact_save");

  form.addEventListener("submit", async (e) => {
    let isValid = true;
    e.preventDefault();

    if (name.value.length === 0) {
      createError(name, "Name cannot be empty");
      isValid = false;
    } else {
      removeError(name);
    }

    if (
      !email.value.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/) ||
      email.value.length === 0
    ) {
      createError(email, "Email is not valid");
      isValid = false;
    } else {
      removeError(email);
    }

    if (message.value.length === 0) {
      createError(message, "Message cannot be empty");
      isValid = false;
    } else {
      removeError(message);
    }
    if (!isValid) return;

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
    message.className = `message-mail-js text-black  ${
      error ? "error" : "success"
    } px-2 py-4 rounded`;
    message.textContent = messageText;

    form.insertAdjacentElement("afterbegin", message);
  }
});

function createError(element, message) {
  error = element.parentNode.querySelector(".error-js");
  if (!error) {
    const error = document.createElement("p");
    error.className = "error-js text-red-500 text-sm";
    error.textContent = message;

    element.parentNode.appendChild(error);
  }
}
function removeError(element) {
  const error = element.parentNode.querySelector(".error-js");

  if (error) {
    error.remove();
  }
}
