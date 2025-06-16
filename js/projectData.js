const projects = [
  {
    name: 'QuantumCT',
    tags: ['Web Development', 'UX Design'],
    group: 'cubedLabs',
    desc: 'QuantumCT is a public-private partnership accelerating the adoption of quantum technologies in Connecticut and working with a broad coalition' +
      ' of partners to lay the groundwork for expansive, equitable economic development.\n\n' +
      'In partnership with the Office of the Vice President for Research, i3 designed and developed a WordPress website for the QauntumCT initiative.',
    link: 'https://quantumct.org/',
    img: 'img/i3/work/quantum.png'
  },
  {
    name: 'Sourcery',
    tags: ['Web Development', 'UX Design', 'Mobile PWA'],
    group: 'dxg',
    desc: 'Sourcery emerged from the design process of Greenhouse Studios and from the project team\'s past work and ongoing interests in research software for the humanities.\n\n' +
      'Working with Greenhouse Studios, we developed an application that gives researchers access to documents that can\'t be found online by paying other researchers to find them.',
    link: 'https://sourceryapp.org/',
    img: 'img/i3/work/sourcery.png'
  },
  {
    name: 'Research Insights for Faculty',
    tags: ['Web Development'],
    group: 'cubedLabs',
    desc: 'Developed with the Office of the Vice President for Research, this application is designed to provide UConn faculty and their ' +
      'staff with monthly financial reports and other tools to help them review and manage their sponsored project accounts.',
    link: 'https://rif.core.uconn.edu/',
    img: 'img/i3/work/rif.png',
    shortName: 'RIF'
  },
  {
    name: 'UConn Impact',
    tags: ['Web Development', 'UX Design', 'Email Marketing'],
    group: 'cubedLabs',
    desc: 'i3 created promotional materials for the UConn Economic Development Forum and redesigned the Impact website to reflect their range of servcies.',
    link: 'https://impact.uconn.edu/',
    img: 'img/i3/work/impact.png'
  },
  {
    name: 'Nexus',
    tags: ['Web Development'],
    group: 'cubedLabs',
    desc: 'Nexus, a University of Connecticut engagement and retention platform, places actionable data in the hands of the advising community to foster student success. ' +
      'Nexus complements the university\'s student support services and enhances information sharing between students, staff, and faculty. Tools include dashboards, appointment scheduling, note sharing, event registration, and more.',
    link: 'https://nexus.uconn.edu/',
    img: 'img/i3/work/nexus.png'
  },
  {
    name: 'WellSAT',
    tags: ['UI Design', 'UX Design'],
    group: 'dxg',
    desc: 'I3 redesigned the Wellness School Assessment Tool (WellSAT) with a user-friendly interface and introduced new features in version 3.0. WellSAT lets you score your written ' +
      'district wellness policy and rate your district’s implementation of school wellness practices.',
    link: 'https://www.wellsat.org/',
    img: 'img/i3/work/wellsat.png'
  },
  {
    name: 'WellSCAN',
    tags: ['Web Development', 'UX Design'],
    group: 'dxg',
    desc: 'What if food banks could better know the quality of their inventory? In collaboration with UConn\'s Rudd Center on Food Policy and Obesity, ' +
      'and with support from Partnership For Healthier America, Feeding America, and others, the DX Lab has developed a suite of web/mobile applications ' +
      'product for use by food banks, food pantries, and other organizations for ranking the nutritional quality of their inventory.\n\n' +
      'This application is housed, licensed and serviced at the University of Connecticut, and includes the WellScan Global nutrition database, WellScan Connect API, WelScan Mini scanning app',
    link: 'https://wellscan.io/',
    img: 'img/i3/work/wellscan.png'
  },
  {
    name: 'CSMNH Shark Illustrations',
    tags: ['Illustration', 'Print Production'],
    group: 'dxg',
    desc: 'i3 worked with the Connecticut State Museum of Natural History to illustrate sharks and print them large enough to become a wall display.',
    link: null,
    img: 'img/i3/work/shark-illustration.jpg'
  },
  {
    name: 'Innovation in Connecticut',
    tags: ['Poster Design', 'Print Production'],
    group: 'cubedLabs',
    desc: '"Innovation in Connecticut" is a feature documentary project delving into the rich tapestry of Connecticut\'s history of innovation, showcasing both established pioneers in ' +
      'various fields as well as emerging young innovators. I3 created the documentary poster for print and web marketing.',
    link: 'https://www.imdb.com/title/tt33371819/',
    img: 'img/i3/work/quantum.png',
    shortName: 'Innovation in CT'
  },
  {
    name: 'EJ TCTAC',
    tags: ['Web Development', 'UX Design'],
    group: 'cubedLabs',
    desc: 'i3 assisted EJ TCTAC in accelerating their website development and meeting the standards of the Environmental Protection Agency.',
    link: 'https://environmental-justice.program.uconn.edu/',
    img: 'img/i3/work/ejtctac.png'
  },
  {
    name: 'Werth Institute',
    tags: ['Web Development', 'UX Design'],
    group: 'cubedLabs',
    desc: 'i3 designed and developed the new primary website for the Werth Institute of Entrepreneurship and Innovation.',
    link: 'https://werth.institute.uconn.edu/',
    img: 'img/i3/work/werth.png',
    shortName: 'Werth',
    longName: 'Werth Institute for Entrepreneurship and Innovation'
  },
  {
    name: 'Covid Surveillance Testing',
    tags: ['Web Development', 'Mobile PWA', 'UX Design'],
    group: 'cubedLabs',
    desc: 'Along with the Institute for Systems Genomics, the DX Group received an award from UConn\'s COVID-19 Rapid Seed Funding (COVID-RSF) Program for creation of a website and dynamic dashboard to showcase the University\'s ' +
      'response to COVID-19 titled "An Integrated Surveillance Program for Improved Detection, Containment and Mitigation of COVID-19."',
    link: 'https://covid-testing.uconn.edu/',
    img: 'img/i3/work/covid-testing.png'
  },
  {
    name: 'POET',
    tags: ['Web Development'],
    group: 'cubedLabs',
    desc: 'Developed with the Office of the Provost, POET is a collection of tools offered by the Provost\'s Office ' +
      'to help streamline operations, foster collaboration, and empower academic decision-making.',
    link: 'https://poet.provost.uconn.edu/',
    img: 'img/i3/work/poet.png'
  },
  {
    name: 'UConn Research',
    tags: ['Web Development', 'UX Design'],
    group: 'cubedLabs',
    desc: 'i3 worked with the Office of the Vice President of Research to redesign their site to reach internal and external audiences.',
    link: 'https://research.uconn.edu/',
    img: 'img/i3/work/ovpr.jpg',
    shortName: 'OVPR'
  },
  {
    name: 'Stamford Data Science',
    tags: ['Web Development', 'UX Design'],
    group: 'dxg',
    desc: 'Under the leadership of Creative Director, DMD Professor Samantha Olschan, our team designed and built the website for UConn\'s new Stamford Data Science Initiative. ' +
      'The web design and development was led by Emily Ha with Faculty Support from Brian Daley, Joel Salisbury, and Mike Vertefeuille.',
    link: null,
    img: 'img/i3/work/sdsi.png'
  },
  {
    name: 'UConn UCEDD',
    tags: ['Web Development', 'UX Design'],
    group: 'dxg',
    desc: 'UCEDD has assisted in the advancement of early intervention, health care, community-based services, inclusive and meaningful education, child care, transition from school to work, ' +
      'employment, recreation and quality assurance, housing, assistive technology, transportation, and/or family support. The DX Group redesigned and developed this website with special care in ensuring it is accessible and inclusive to all.',
    link: 'https://uconnucedd.org/',
    img: 'img/i3/work/ucedd.png',
    shortName: 'UCEDD'
  },
  {
    name: 'CFNI Calculator',
    tags: ['Web Development', 'UX Design'],
    group: 'dxg',
    desc: 'The UConn Rudd Center uses the CFNI to help food banks summarize the overall nutritional quality of a foods into a single score. We built them this web-based calculator to help make that easier.',
    link: 'https://uconnruddcenter.org/cfni/',
    img: 'img/i3/work/cfni.png',
    shortName: 'CFNI',
    longName: 'Charitable Food Nutrition Index Calculator',
  },
  {
    name: 'Breadwinner Game',
    tags: ['Web Development', 'UX Design'],
    group: 'dxg',
    desc: 'Are you ready to try out life as a young adult entering the Connecticut workforce fulltime? During this game, you’ll have a chance to make financial decisions you are likely to face. In this game, you are a young, ' +
      'single adult and have completed the entry level educational requirements for your chosen occupation.',
    link: 'https://career.uconn.edu/resources/the-breadwinner-game/',
    img: 'img/i3/work/financial-game.png',
    shortName: 'Breadwinner'
  },
  {
    name: 'Voice Switch/Brain Switch',
    tags: ['Web Development', 'UX Design'],
    group: 'dxg',
    desc: 'Voice Switch/Brain Switch is an interdisciplinary study run by a language scientist and a theatre dialect coach. In Summer 2021, we designed and launched the website for this project. Branding Design provided by Digital Media & Design professor Ting Zhou.',
    link: 'https://voiceswitch.sfa.uconn.edu/',
    img: 'img/i3/work/brain-switch.png',
    shortName: 'Voice/Brain Switch'
  },
  {
    name: 'Access2Ag',
    tags: ['Web Development', 'Mobile PWA', 'UX Design'],
    group: 'dxg',
    desc: 'Access2Ag is an initiative of Connecticut Resource Conservation and Development (CT RC&D) in which they plan to use their close working relationships with agriculture producers and partner organizations to address the critical ' +
      'need of bringing nutrient-rich and healthy foods to at-risk members of the Eastern Connecticut community.\n\n' +
      'This is a collaboration with Connecticut Resource Conservation and Development (CT RC&D), Digital Experience (DX) Group, and the Center for Open Research Resources and Equipment (COR²E).',
    link: 'https://access2ag.com/',
    img: 'img/i3/work/access2ag.png'
  },
  {
    name: 'Travel Funds',
    tags: ['Web Development'],
    group: 'cubedLabs',
    desc: 'This website allows the submission and management of UConn Faculty travel fund requests.',
    link: 'https://travelfunds.core.uconn.edu/',
    img: 'img/i3/work/travel-funds.png',
    longName: 'Faculty Travel Funding'
  },
  {
    name: 'COR²E Website',
    tags: ['Web Development', 'UX Design'],
    group: 'cubedLabs',
    desc: 'i3 designed, developed, and maintains the primary website for the Center for Open Research Resources and Equipment (COR²E).',
    link: 'https://core.uconn.edu/',
    img: 'img/i3/work/core.png',
    shortName: 'COR²E',
    longName: 'Center for Open Research Resources and Equipment (COR²E)'
  },
  {
    name: 'UConn NRCA',
    tags: ['UX Design'],
    group: 'dxg',
    desc: 'The DX Group redesigned and launched the UConn NRCA website to engage diverse teen and adult participants in natural resources conservation.',
    link: 'https://nrca.uconn.edu/',
    img: 'img/i3/work/nrca.png',
    shortName: 'NRCA',
    longName: 'UConn Natural Resources Conservation Academy'
  },
  {
    name: 'Physiology and Neurobiology',
    tags: ['Web Development', 'UX Design'],
    group: 'dxg',
    desc: 'During Summer 2021, we redesigned and launched the website for the UConn Physiology & Neurobiology department.',
    link: 'https://pnb.uconn.edu/',
    img: 'img/i3/work/PNB.png',
    shortName: 'PNB',
    longName: 'UConn Physiology and Neurobiology'
  },
  {
    name: 'CMOT',
    tags: ['Web Development', 'UX Design'],
    group: 'dxg',
    desc: 'What if classroom evaluators had a tablet app for their in-class assessment? We built CMOT (Classroom Management Observation Tool) under the direction of ' +
      'Dr. Jen Freeman of the UConn Neag School of Education and her associated UConn REP (Research Excellence Program) grant. It allows observers to enter progress monitoring items, ' +
      'which have been validated for informing decisions about relative strengths/needs with positive and proactive classroom management. It also contains a checklist of empirically-supported practice features to periodically "look for".',
    link: null,
    img: 'img/i3/work/cmot.png'
  },
  {
    name: 'DMCT',
    tags: ['Web Development', 'UX Design'],
    group: 'dxg',
    desc: 'The DX Group built and maintains an ever-growing digital presence to serve as the central source of Information about Connecticut\'s Digital Media Industry and Education scene. ' +
      'We created a digital platform to serve as the central hub for Digital Media Education and Industry in the state of CT.',
    link: 'https://digitalmediact.com/',
    img: 'img/i3/work/dmct.png'
  },
  {
    name: 'TurfGrass Application',
    tags: ['Web Development', 'UX Design'],
    group: 'dxg',
    desc: 'Launching soon!',
    link: null,
    img: 'img/i3/work/turfgrass.png',
    shortName: 'TurfGrass',
    longName: 'TurfGrass / Athletic Field Assessment Tool'
  },
  {
    name: 'Hiring Maps',
    tags: ['Web Development', 'UX Design'],
    group: 'dxg',
    desc: 'In partnership with the UConn Department of Agriculture & Resource Economics and the Digital Experience Group, the Hiring Maps project is a go-to resource for navigating Connecticut\'s job market. ' +
      'On this website you can explore counties and wages, track monthly job postings, and discover related jobs & occupations to make informed career decisions.',
    link: 'https://hiring-maps-63410.web.app/',
    img: 'img/i3/work/hiring-maps.png'
  },
  {
    name: 'Extension Publications',
    tags: ['Web Development', 'UX Design'],
    group: 'dxg',
    desc: 'i3 designed and developed the publication search template used in the College of Agriculture, Health and Natural Resources - Extension News and Publications website.',
    link: 'https://publications.extension.uconn.edu/publications/',
    img: 'img/i3/work/extension.png',
    longName: 'CAHNR Extension Publications'
  },
  {
    name: 'Ecoregions',
    tags: ['Web Development', 'UX Design'],
    group: 'dxg',
    desc: 'Launching soon!',
    link: null,
    img: 'img/i3/work/ecoregions.png'
  },
  {
    name: 'Rain Garden',
    tags: ['Web Development', 'Mobile PWA', 'UX Design'],
    group: 'dxg',
    desc: 'During Fall \'20, we were approached by new friend David Dickson of the CT NEMO Program. CT NEMO maintains Rain Garden App, a FREE PWA (Progressive Web App). ' +
      'Through video tutorials, diagrams, text, and tools, the App guides users through how to properly locate, size, install, plant, and maintain a rain garden to help protect local waterways.',
    link: 'https://rgapp.nemo.uconn.edu/',
    img: 'img/i3/work/rain-garden.png'
  },
  {
    name: 'Pandemic Journaling Project',
    tags: ['Web Development', 'UX Design'],
    group: 'dxg',
    desc: 'i3 worked with the Pandemic Journaling Project to develop a search and filter interface for their featured entries.',
    link: 'https://pandemic-journaling-project.chip.uconn.edu/featured-entries/',
    img: 'img/i3/work/pandemic-journaling.png'
  },
  {
    name: 'USDA RMA and FSA Crop Reporting Deadlines',
    tags: ['Web Development', 'Email Notifications'],
    group: 'dxg',
    desc: 'I3 created the USDA RMA and FSA Program Deadlines reminder tool that allows policyholders to sign up for text and email reminders for their crop reporting deadlines.',
    link: 'https://cropdeadlines.core.uconn.edu/login',
    img: 'img/i3/work/crop-insurance.png',
    shortName: 'Crop Reporting Deadlines'
  },
]
export default projects;