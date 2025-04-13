
const nextDom = document.getElementById('next');
const prevDom = document.getElementById('prev');
const carouselDom = document.querySelector('.carousel');
const SliderDom = carouselDom.querySelector('.carousel .list');
const thumbnailBorderDom = carouselDom.querySelector('.thumbnail');
const timeDom = carouselDom.querySelector('.time');


let thumbnailItemsDom = thumbnailBorderDom.querySelectorAll('.item');
thumbnailBorderDom.appendChild(thumbnailItemsDom[0]);

const timeRunning = 3000;
const timeAutoNext = 7000;

let runTimeOut;
let runNextAuto = setTimeout(() => {
  nextDom.click();
}, timeAutoNext);


nextDom.onclick = () => showSlider('next');
prevDom.onclick = () => showSlider('prev');


function showSlider(direction) {
  const SliderItemsDom = SliderDom.querySelectorAll('.item');
  const thumbnailItemsDom = thumbnailBorderDom.querySelectorAll('.item');

  if (direction === 'next') {
    SliderDom.appendChild(SliderItemsDom[0]);
    thumbnailBorderDom.appendChild(thumbnailItemsDom[0]);
    carouselDom.classList.add('next');
  } else {
    SliderDom.prepend(SliderItemsDom[SliderItemsDom.length - 1]);
    thumbnailBorderDom.prepend(thumbnailItemsDom[thumbnailItemsDom.length - 1]);
    carouselDom.classList.add('prev');
  }


  clearTimeout(runTimeOut);
  runTimeOut = setTimeout(() => {
    carouselDom.classList.remove('next', 'prev');
  }, timeRunning);


  clearTimeout(runNextAuto);
  runNextAuto = setTimeout(() => {
    nextDom.click();
  }, timeAutoNext);
}


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
  
  const menuToggle = document.getElementById('menu-toggle');
  const navList = document.querySelector('.navigation ul');

  menuToggle.addEventListener('click', () => {
    navList.classList.toggle('show');
  });

