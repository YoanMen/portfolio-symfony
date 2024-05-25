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

      // disable send button
      submitBut.disabled = true;

      // add alert message
      const successText = document.createElement("p");
      successText.classList.add("text-green-400", "text-lg", "alert");
      successText.innerText =
        "Your message has been sent and you will be contacted shortly.";

      form.insertAdjacentElement("afterbegin", successText);
    }
  }
});
