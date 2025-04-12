async function getSuggestion() {
    const input = document.getElementById("userInput").value;
    const responseEl = document.getElementById("response");
    responseEl.innerText = "Thinking... 🤖";

    const res = await fetch("https://openrouter.ai/api/v1/chat/completions", {
      method: "POST",
      headers: {
        "Authorization": "Bearer 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", 
        "Content-Type": "application/json"
      },
      body: JSON.stringify({
        model: "mistralai/mistral-7b-instruct", 
        messages: [
          {
            role: "system",
            content: "You are a helpful medical assistant. Based on the symptoms, suggest the correct type of doctor to consult. If it's serious, suggest visiting the ER."
          },
          {
            role: "user",
            content: input
          }
        ]
      })
    });

    const data = await res.json();
    console.log(data);

    const reply = data?.choices?.[0]?.message?.content || "⚠️ No response received.";
    responseEl.innerText = reply;
  }