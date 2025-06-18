const employees = [
  {
    name: 'Joel Salisbury',
    id: 'joel-salis',
    title: 'Director of Internal Insights and Innovation',
    img: 'img/i3/people/salisbury-narrow.jpg',
    isStudent: false,
    gradient: '7, 51, 51',
    linkedIn: 'https://www.linkedin.com/in/salisburyj/',
    tags: ['Tag 1', 'Tag 2'],
    bio: "Whoah this person is so cool they like do design stuff and they're a student and like they're talented and probably have hobbies that's wild. " +
      "I wonder if any of the students have pets that'd be cool. I bet they've got some interesting stuff to put in their bio I should probably get those bios huh. " +
      "Lots of cool stuff goin on over here like cool student work and stuff."
  },
  {
    name: 'Brian Kelleher',
    id: 'brian-kell',
    title: 'Senior Applications Developer',
    img: 'img/i3/people/kelleher.jpg',
    isStudent: false,
    gradient: '0, 0, 0',
    linkedIn: 'https://www.linkedin.com/in/briankelleher1/',
    tags: ['Tag 1', 'Tag 2'],
    bio: "Whoah this person is so cool they like do design stuff and they're a student and like they're talented and probably have hobbies that's wild. " +
      "I wonder if any of the students have pets that'd be cool. I bet they've got some interesting stuff to put in their bio I should probably get those bios huh. " +
      "Lots of cool stuff goin on over here like cool student work and stuff."
  },
  {
    name: 'Natalie Lacroix',
    id: 'natalie-lacr',
    title: 'Senior UI/UX Designer',
    img: 'img/i3/people/lacroix.jpg',
    isStudent: false,
    gradient: '48, 10, 49',
    linkedIn: 'https://www.linkedin.com/in/natalie-lacroix-510a42188/',
    tags: ['Tag 1', 'Tag 2'],
    bio: "Whoah this person is so cool they like do design stuff and they're a student and like they're talented and probably have hobbies that's wild. " +
      "I wonder if any of the students have pets that'd be cool. I bet they've got some interesting stuff to put in their bio I should probably get those bios huh. " +
      "Lots of cool stuff goin on over here like cool student work and stuff."
  },
  {
    name: 'Jeff Winston',
    id: 'jeff-winst',
    title: 'Director of Nexus Student Success Platform',
    img: 'img/i3/people/winston.jpg',
    isStudent: false,
    gradient: '51, 37, 7',
    linkedIn: 'https://www.linkedin.com/',
    tags: ['Tag 1', 'Tag 2'],
    bio: "Whoah this person is so cool they like do design stuff and they're a student and like they're talented and probably have hobbies that's wild. " +
      "I wonder if any of the students have pets that'd be cool. I bet they've got some interesting stuff to put in their bio I should probably get those bios huh. " +
      "Lots of cool stuff goin on over here like cool student work and stuff."
  },
  {
    name: 'Brian Daley',
    id: 'brian-daley',
    title: 'DMD Faculty Advisor',
    img: 'img/i3/people/daley.jpg',
    isStudent: false,
    gradient: '7, 14, 51',
    linkedIn: 'https://www.linkedin.com/in/brianpdaley/',
    tags: ['Tag 1', 'Tag 2'],
    bio: "Whoah this person is so cool they like do design stuff and they're a student and like they're talented and probably have hobbies that's wild. " +
      "I wonder if any of the students have pets that'd be cool. I bet they've got some interesting stuff to put in their bio I should probably get those bios huh. " +
      "Lots of cool stuff goin on over here like cool student work and stuff."
  },
  {
    name: 'Michael Vertefeuille',
    id: 'mike-vert',
    title: 'DMD Faculty Advisor',
    img: 'img/i3/people/vert-narrow.jpg',
    isStudent: false,
    gradient: '51, 31, 7',
    linkedIn: 'https://www.linkedin.com/in/michaelvertefeuille/',
    tags: ['Tag 1', 'Tag 2'],
    bio: "Whoah this person is so cool they like do design stuff and they're a student and like they're talented and probably have hobbies that's wild. " +
      "I wonder if any of the students have pets that'd be cool. I bet they've got some interesting stuff to put in their bio I should probably get those bios huh. " +
      "Lots of cool stuff goin on over here like cool student work and stuff."
  },
  {
    name: 'Emma Adams',
    id: 'emma-adams',
    title: 'Student Web Developer',
    img: 'img/i3/people/adams.jpg',
    isStudent: true,
    gradient: '7, 46, 51',
    linkedIn: 'https://linkedin.com/',
    tags: ['Laravel', 'Javascript'],
    bio: "Whoah this person is so cool they like do design stuff and they're a student and like they're talented and probably have hobbies that's wild. " +
      "I wonder if any of the students have pets that'd be cool. I bet they've got some interesting stuff to put in their bio I should probably get those bios huh. " +
      "Lots of cool stuff goin on over here like cool student work and stuff."
  },
  {
    name: 'Lauren Busavage',
    id: 'lauren-busav',
    title: 'Student Web Developer',
    img: 'img/i3/people/busavage.png',
    isStudent: true,
    gradient: '0, 0, 0',
    linkedIn: 'https://linkedin.com/',
    tags: ['Aurora', 'Sketches'],
    bio: "Whoah this person is so cool they like do design stuff and they're a student and like they're talented and probably have hobbies that's wild. " +
      "I wonder if any of the students have pets that'd be cool. I bet they've got some interesting stuff to put in their bio I should probably get those bios huh. " +
      "Lots of cool stuff goin on over here like cool student work and stuff."

  },
  {
    name: 'Kelis Clarke',
    id: 'kelis-clarke',
    title: 'Student UI/UX Designer',
    img: 'img/i3/people/jonathan.jpg',
    isStudent: true,
    gradient: '0, 0, 0',
    linkedIn: 'https://linkedin.com/',
    tags: ['Tag 1', 'Tag 2'],
    bio: "Whoah this person is so cool they like do design stuff and they're a student and like they're talented and probably have hobbies that's wild. " +
      "I wonder if any of the students have pets that'd be cool. I bet they've got some interesting stuff to put in their bio I should probably get those bios huh. " +
      "Lots of cool stuff goin on over here like cool student work and stuff."
  },
  {
    name: 'Ryan Cohutt',
    id: 'ryan-cohutt',
    title: 'Student UI/UX Designer',
    img: 'img/i3/people/jonathan.jpg',
    isStudent: true,
    gradient: '0, 0, 0',
    linkedIn: 'https://linkedin.com/',
    tags: ['Tag 1', 'Tag 2'],
    bio: "Whoah this person is so cool they like do design stuff and they're a student and like they're talented and probably have hobbies that's wild. " +
      "I wonder if any of the students have pets that'd be cool. I bet they've got some interesting stuff to put in their bio I should probably get those bios huh. " +
      "Lots of cool stuff goin on over here like cool student work and stuff."
  },
  {
    name: 'Maggie Danielewicz',
    id: 'maggie-daniel',
    title: 'Student Web Developer',
    img: 'img/i3/people/danielewicz.jpg',
    isStudent: true,
    gradient: '30, 50, 30',
    linkedIn: 'https://linkedin.com/',
    tags: ['Tag 1', 'Tag 2'],
    bio: "Whoah this person is so cool they like do design stuff and they're a student and like they're talented and probably have hobbies that's wild. " +
      "I wonder if any of the students have pets that'd be cool. I bet they've got some interesting stuff to put in their bio I should probably get those bios huh. " +
      "Lots of cool stuff goin on over here like cool student work and stuff."
  },
  {
    name: 'Luna Gonzalez',
    id: 'luna-gonzal',
    title: 'Student Illustrator',
    img: 'img/i3/people/luna.jpg',
    isStudent: true,
    gradient: '30, 50, 30',
    linkedIn: 'https://linkedin.com/',
    tags: ['Tag 1', 'Tag 2'],
    bio: "Whoah this person is so cool they like do design stuff and they're a student and like they're talented and probably have hobbies that's wild. " +
      "I wonder if any of the students have pets that'd be cool. I bet they've got some interesting stuff to put in their bio I should probably get those bios huh. " +
      "Lots of cool stuff goin on over here like cool student work and stuff."
  },
  {
    name: 'Aaron Mark',
    id: 'aaron-mark',
    title: 'Student Web Developer',
    img: 'img/i3/people/jonathan.jpg',
    isStudent: true,
    gradient: '0, 0, 0',
    linkedIn: 'https://linkedin.com/',
    tags: ['Tag 1', 'Tag 2'],
    bio: "Whoah this person is so cool they like do design stuff and they're a student and like they're talented and probably have hobbies that's wild. " +
      "I wonder if any of the students have pets that'd be cool. I bet they've got some interesting stuff to put in their bio I should probably get those bios huh. " +
      "Lots of cool stuff goin on over here like cool student work and stuff."
  },
  {
    name: 'Jack Medrek',
    id: 'jack-medrek',
    title: 'Student Software Developer',
    img: 'img/i3/people/medrek.jpg',
    isStudent: true,
    gradient: '1, 7, 41',
    linkedIn: 'https://linkedin.com/',
    tags: ['Tag 1', 'Tag 2'],
    bio: "Whoah this person is so cool they like do design stuff and they're a student and like they're talented and probably have hobbies that's wild. " +
      "I wonder if any of the students have pets that'd be cool. I bet they've got some interesting stuff to put in their bio I should probably get those bios huh. " +
      "Lots of cool stuff goin on over here like cool student work and stuff."
  },
  {
    name: 'Kailey Moore',
    id: 'kailey-moore',
    title: 'Student UI/UX Designer',
    img: 'img/i3/people/moore.jpg',
    isStudent: true,
    gradient: '38, 0, 76',
    linkedIn: 'https://linkedin.com/',
    tags: ['Tag 1', 'Tag 2'],
    bio: "Whoah this person is so cool they like do design stuff and they're a student and like they're talented and probably have hobbies that's wild. " +
      "I wonder if any of the students have pets that'd be cool. I bet they've got some interesting stuff to put in their bio I should probably get those bios huh. " +
      "Lots of cool stuff goin on over here like cool student work and stuff."
  },
  {
    name: 'William Shostak',
    id: 'william-shostak',
    title: 'Student Software Developer',
    img: 'img/i3/people/shostak.jpg',
    isStudent: true,
    gradient: '0, 0, 0',
    linkedIn: 'https://linkedin.com/',
    tags: ['Tag 1', 'Tag 2'],
    bio: "Whoah this person is so cool they like do design stuff and they're a student and like they're talented and probably have hobbies that's wild. " +
      "I wonder if any of the students have pets that'd be cool. I bet they've got some interesting stuff to put in their bio I should probably get those bios huh. " +
      "Lots of cool stuff goin on over here like cool student work and stuff."
  },
  {
    name: 'Emelia Salmon',
    id: 'emelia-salmon',
    title: 'Student UI/UX Designer',
    img: 'img/i3/people/jonathan.jpg',
    isStudent: true,
    gradient: '0, 0, 0',
    linkedIn: 'https://linkedin.com/',
    tags: ['Tag 1', 'Tag 2'],
    bio: "Whoah this person is so cool they like do design stuff and they're a student and like they're talented and probably have hobbies that's wild. " +
      "I wonder if any of the students have pets that'd be cool. I bet they've got some interesting stuff to put in their bio I should probably get those bios huh. " +
      "Lots of cool stuff goin on over here like cool student work and stuff."
  },
  {
    name: 'Victoria Brey',
    id: 'victoria-brey',
    title: 'Student Web Developer',
    img: 'img/i3/people/jonathan.jpg',
    isStudent: true,
    gradient: '0, 0, 0',
    linkedIn: 'https://linkedin.com/',
    tags: ['Tag 1', 'Tag 2'],
    bio: "Whoah this person is so cool they like do design stuff and they're a student and like they're talented and probably have hobbies that's wild. " +
      "I wonder if any of the students have pets that'd be cool. I bet they've got some interesting stuff to put in their bio I should probably get those bios huh. " +
      "Lots of cool stuff goin on over here like cool student work and stuff."
  }
];
export default employees;