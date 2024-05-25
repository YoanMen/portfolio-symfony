document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("#contact-form");
  const submitBut = document.querySelector("#contact_save");

  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    const name = document.querySelector("#contact_name").value;
    const email = document.querySelector("#contact_email").value;
    const message = document.querySelector("#contact_message").value;
    const contactType = document.querySelector("#contact_contactType").value;

    const r = await fetch("/api/contact", {
      method: "POST",
      headers: { "Content-type": "application/json" },
      body: JSON.stringify({ name, email, message, contactType }),
    })
      .then((response) => response.json())
      .catch((error) => console.log(error));

    console.log(r);
    setMessage(r);
  });

  function setMessage(response) {
    const alertMessage = form.querySelector(".alert");
    if (alertMessage) alertMessage.remove();

    if (!response.success) {
      const errorText = document.createElement("p");
      errorText.classList.add("text-red-400", "text-lg", "alert");
      errorText.innerText =
        "There was an issue with your request : " + response.error;

      form.insertAdjacentElement("afterbegin", errorText);
    } else {
      submitBut.classList.remove(
        "hover:opacity-95",
        "active:opacity-80",
        "cursor-pointer"
      );
      submitBut.classList.add("opacity-50");

      submitBut.disabled = true;
      const successText = document.createElement("p");
      successText.classList.add("text-green-400", "text-lg", "alert");
      successText.innerText =
        "Your message has been sent and you will be contacted shortly.";

      form.insertAdjacentElement("afterbegin", successText);
    }
  }
});
