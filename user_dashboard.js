const content = document.getElementById('content');

const navLinks = document.querySelectorAll('nav a');

const yearSpan = document.getElementById('year');

yearSpan.textContent = new Date().getFullYear();



navLinks.forEach(link => {

  link.addEventListener('click', async (e) => {

    e.preventDefault();

    const section = link.getAttribute('data-section');

    loadSectionData(section);

  });

});



async function loadSectionData(section) {

  content.innerHTML = '<p class="loading">Loading your data...</p>';



  if (section === 'home') {

    renderContent('home');

    return;

  }



  try {


    const response = await fetch(`/api/${section}`);

    if (!response.ok) throw new Error('Failed to fetch data.');

    const data = await response.json();

    renderContent(section, data);

  } catch (error) {

    content.innerHTML = `<p>Something went wrong: ${error.message}</p>`;

  }

}



function renderContent(section, data = {}) {

  let html = '';

  switch (section) {

    case 'home':

      html = `

        <h2>Welcome Back 👋</h2>

        <p class="intro">

          We're glad to see you again. Use the menu above to view your profile, check appointments, review reports, and stay on top of your health journey.

          Everything you need is just a click away.

        </p>

      `;

      break;

    case 'profile':

      html = `

        <h2>Your Profile</h2>

        <p><strong>Name:</strong> ${data.name}</p>

        <p><strong>Contact:</strong> ${data.contact}</p>

        <p><strong>Address:</strong> ${data.address}</p>

      `;

      break;

    case 'appointments':

      html = `

        <h2>Upcoming Appointments</h2>

        ${data.length > 0 ? data.map(item => `<p>${item.date} — ${item.doctor}</p>`).join('') : '<p>No upcoming appointments.</p>'}

      `;

      break;

    case 'reports':

      html = `

        <h2>Medical Reports</h2>

        ${data.length > 0 ? data.map(report => `<p>${report.title}: ${report.result}</p>`).join('') : '<p>No reports available.</p>'}

      `;

      break;

    case 'medicine':

      html = `

        <h2>Medication List</h2>

        ${data.length > 0 ? data.map(med => `<p>${med.name} - ${med.dosage}</p>`).join('') : '<p>No medications recorded.</p>'}

      `;

      break;

    case 'health':

      html = `

        <h2>Health Overview</h2>

        <p>Blood Pressure: ${data.bp}</p>

        <p>Heart Rate: ${data.heartRate}</p>

        <p>Status: ${data.status}</p>

      `;

      break;

    case 'calendar':

      html = `

        <h2>Next Checkup</h2>

        <p>${data.nextCheckupDate || 'You have no scheduled checkups yet.'}</p>

      `;

      break;

    default:

      html = '<p>Please select a valid section.</p>';

  }



  content.innerHTML = html;

}


renderContent('home');
