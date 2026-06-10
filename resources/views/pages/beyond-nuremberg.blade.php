@extends('layouts.app')
@section('title', 'Beyond Nuremberg')
@section('meta_description', 'Players of this VR time-travel quest will investigate Holocaust history as it unfolded in what is today Western Ukraine. With the aid of an archivist-guide, individuals journey across time and space to collect clues at different sites.')

@section('content')

<style>
.bn { max-width: 1100px; margin: 0 auto; padding: 0 clamp(20px, 5vw, 50px); }
.bn-hero img { max-width: 560px; }
.bn-row { display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; align-items: center; }
.bn-row--flip .bn-figure { order: 2; }
.bn-figure figcaption { font-size: 0.85rem; color: #999; font-style: italic; margin-top: 0.6rem; }
.bn-logos { display: grid; grid-template-columns: repeat(2, 1fr); align-items: center; justify-items: center; width: 100%; max-width: 900px; margin-inline: auto; }
.bn-logos__slot { display: flex; align-items: center; justify-content: center; width: 100%; height: 140px; }
.bn-logos img { height: 48px; max-width: 100%; object-fit: contain; display: block; }
.bn-logos img.bn-logos__i3 { height: 96px; }
.bn-logos img.bn-logos__unc { height: 140px; }
.funding-callout { background: rgba(36,147,225,.1); border: 1px solid rgba(77,179,255,.3); border-left: 4px solid #4DB3FF; border-radius: 0 8px 8px 0; padding: 1.25rem 1.5rem; }
@media (max-width: 768px) {
  .bn-row { grid-template-columns: 1fr; }
  .bn-row--flip .bn-figure { order: 0; }
  .bn-logos { grid-template-columns: 1fr; max-width: 320px; }
  .bn-logos__slot { height: auto; min-height: 80px; }
}
</style>

<div class="bn pt-5">
  <h1 class="text-center mb-5 bn-hero">
    <img class="img-fluid d-block mx-auto" src="{{ asset('img/beyond-nuremberg/HeroWhite.png') }}" alt="Beyond Nuremberg: A VR History Quest">
  </h1>

  <div class="d-flex flex-column gap-3 line-height-1_8">
              <strong>Beyond Nuremberg: A VR History Quest</strong>
              <span data-contrast="none"><em>Beyond Nuremberg</em> is an interactive, headset-based virtual reality (VR) game in which players join a time-travel research team. Armed with a chronogeometer, the tech that makes jumping to past times and places possible, they visit historic sites, search for artifacts, and collect clues to analyze back in the Archives. The first chapter, "Mission: Ukraine," connects Nazi war crimes tried in 1945–46 before the International Military Tribunal (IMT) in Nuremberg, Germany, to the Jewish community of Tuchyn, Ukraine.  </span>
              <b><span data-contrast="none">The Tuchyn Story </span></b>
              <span data-contrast="none">The journey begins in Courtroom 600 of Nuremberg's Palace of Justice, where the trial of Nazi war criminals is underway. Successfully collecting and examining clues unlocks new destinations. The player decides which trail to follow next. One path leads back in time and east to Tuchyn, a town where 3,000 Jews lived and raised families under Nazi occupation. Players explore a garment factory where a spool of thread, a crust of bread, and other ordinary objects reveal individual lives. They meet survivor Herman Wajcman, whose testimony teaches players about forced labor, persecution, and the armed uprising that the Jewish community mounted in 1942. The unfolding story connects individual experiences to the administrative machinery of genocide as overseen by IMT defendant Alfred Rosenberg, the Nazi official responsible for the Occupied Eastern Territories. This progression links legal accountability with lived experience, foregrounding Jewish lives, agency, and testimony. </span>
              <figure class="bn-figure m-0">
                <img class="img-fluid rounded" src="{{ asset('img/beyond-nuremberg/Fig 1_DefendantBox.jpg') }}" alt="The defendants' box in Courtroom 600, rendered in a style inspired by courtroom sketches from the Trial of the Major War Criminals at Nuremberg, 1945–46.">
                <figcaption>The defendants' box in Courtroom 600, rendered in a style inspired by courtroom sketches from the Trial of the Major War Criminals at Nuremberg, 1945–46.</figcaption>
              </figure>
              <div class="bn-row bn-row--flip">
                <span data-contrast="none">The game's journey culminates at the Holocaust memorial in present-day Tuchyn, where the player lights candles to illuminate the monument. Through photographs laid at its base, they encounter familiar names and new ones among the honored dead, including Paula Wajcman, Herman’s sister. Each name is specific. Each life is particular. A Mission Report at the close of the experience connects players to museums, archives, and other repositories where they can continue exploring the primary sources and history they encountered in the game.</span>
                <figure class="bn-figure m-0">
                  <img class="img-fluid rounded" src="{{ asset('img/beyond-nuremberg/Fig 2_Monument detail.png') }}" alt="Detail of the present-day Holocaust memorial in Tuchyn, Ukraine, recreated using 3D photogrammetry of the monument and environs.">
                  <figcaption>Detail of the present-day Holocaust memorial in Tuchyn, Ukraine, recreated using 3D photogrammetry of the monument and environs.</figcaption>
                </figure>
              </div>

              <strong>Sharpening Critical Thinking  </strong>
              <div class="bn-row">
                <figure class="bn-figure m-0">
                  <img class="img-fluid rounded" src="{{ asset('img/beyond-nuremberg/Fig 3_Ed Expo player.JPG') }}" alt="An attendee at ED Games Expo investigates objects in the courtroom as they explore an early proof-of-concept build.">
                  <figcaption>An attendee at ED Games Expo investigates objects in the courtroom as they explore an early proof-of-concept build.</figcaption>
                </figure>
                <span data-contrast="none">Analyzing clues is not only how the story unfolds; it is also how players build skills. Question-and-answer sequences guide players as they examine court documents, photographs, oral testimonies, and other primary sources drawn from Holocaust museums and archives. As players progress, the game grows more demanding. Not everything they encounter is what it appears.</span>
              </div>
              <span data-contrast="none">Some historic sources are intentional instruments of deception: propaganda that presents dehumanizing falsehoods as fact. Players must learn to identify not just what these documents say, but what they are and what they did. A second category is more unsettling: modern-day forgeries planted in the past by another time traveler. An alert from the team’s equipment signals when something is amiss in the environment. How and why these fakes got to the past is a mystery the player must help solve. Distinguishing period propaganda from faked history builds players' ability to evaluate evidence and assess its validity—timely skills in an age of digital disinformation. </span>
              <div class="bn-row bn-row--flip">
                <span data-contrast="none"><em>Beyond Nuremberg</em>'s mission is to foster awareness of the human impacts and legacies of the Holocaust for a new generation. Recent studies show that broad cultural knowledge of the Holocaust is declining among younger Americans even as misinformation and denial, including denial of the evidence presented at Nuremberg, continue to proliferate online. The game is designed to engage the 18- to 34-year-olds who are among the 158.6 million U.S. adults (60% of the adult population) who currently play video games. Complex narratives that unfold across time and space, rewarding gradual mastery of new skills, are central to this project. They are also features valued by the story-driven players we aim to reach.</span>
                <figure class="bn-figure m-0">
                  <img class="img-fluid rounded" src="{{ asset('img/beyond-nuremberg/Fig 4_Pop Up.jpg') }}" alt="Etched in Stone is a pop-up exhibit about Tuchyn's Jewish community developed by UNC Greensboro researchers. It enriches current playtesting and points to the deep historical research shaping the game.">
                  <figcaption>Etched in Stone is a pop-up exhibit about Tuchyn's Jewish community developed by UNC Greensboro researchers. It enriches current playtesting and points to the deep historical research shaping the game.</figcaption>
                </figure>
              </div>

              <strong>Building the Game, Advancing the Field   </strong>
              <span data-contrast="none"><em>Beyond Nuremberg</em> is being developed by an interdisciplinary team of faculty, developers, designers, and other talents working at the University of Connecticut and the University of North Carolina Greensboro. The game is designed for MetaQuest 3 and Vive Pro headsets and built for 3–5 hours of single-player engagement. The team is currently constructing a full playable build of “Mission: Ukraine,” with formative assessments guiding ongoing iteration to ensure the game meets its core goals: building historical knowledge, developing critical thinking skills, and fostering sustained engagement with Holocaust history.  </span>
              <span data-contrast="none">As part of that work, the team is developing the Archive Access Plug-in, new open-source software that allows materials held in online repositories to be rendered and handled in Unity3D environments. The plug-in addresses a technical gap to better allow the use of archival primary sources in VR environments. It will be freely available to others working at the intersection of public history and immersive media. </span>


              <div class="bn-logos my-4">
                <div class="bn-logos__slot">
                  <img class="bn-logos__i3" src="{{ asset('img/beyond-nuremberg/i3Stacked.png') }}" alt="Institutional Insights and Innovation">
                </div>
                <div class="bn-logos__slot">
                  <img class="bn-logos__unc" src="{{ asset('img/beyond-nuremberg/uncGreensboroDOH.png') }}" alt="UNC Greensboro Department of History">
                </div>
              </div>


              <div class="funding-callout">
                <span>Development of <em>Beyond Nuremberg</em> is supported by a National Endowment for the Humanities Digital Projects for the Public Discovery Grant, a University of Connecticut Research Excellence Program and School of Fine Arts Dean’s Grant; funding from The Dodd Center and the UConn Office of Global Affairs, and a UNC Greensboro Internal Research Award.</span>
              </div>


              <strong><em>Beyond Nuremberg</em> in the News:</strong>
              <ul>
                <li style="list-style-type: none;">
                  <ul>
                    <li>"Beyond Nuremberg: A Prototype Playtest," showcase at <a href="https://www.digitalmemorylab.com/events/" target="_blank" rel="noopener">Inaugural Connective Holocaust Commemoration Expo 2025</a>, Landecker Digital Memory Lab, University of Sussex, England.</li>
                    <li><a href="https://youtu.be/QAtibihA2XU" target="_blank" rel="noopener">A Virtual Reality Encounter with Evidence of the Holocaust</a> presentation at The Digitalisation of Memory: Technology – Possibilities – Boundaries,  a 2021 symposium of the Falstad Centre and Museum (Norway) and POLIN Museum (Poland).</li>
                    <li>Vos, R., &amp; Stolk, S. (2022). "Courtroom 600: The (Virtual) Reality of Being There." International Criminal Law Review, 22(1-2), 308-327. <a href="https://doi.org/10.1163/15718123-bja10090" target="_blank" rel="noopener">https://doi.org/10.1163/15718123-bja10090</a></li>
                    <li><a href="https://www.apa.org/monitor/2019/09/games-impact" target="_blank" rel="noopener">Monitor on Psychology: Games with Impact</a></li>
                    <li><a href="https://today.uconn.edu/2019/01/reviving-holocaust-history-virtual-reality/" target="_blank" rel="noopener">UConn Today: Engaging Holocaust History with Virtual Reality</a></li>
                    <li><a href="https://theconversation.com/digital-technology-offers-new-ways-to-teach-lessons-from-the-holocaust-102023" target="_blank" rel="noopener">The Conversation: Digital technology offers new ways to teach lessons from the Holocaust</a></li>
                    <li><a href="https://www.timesofisrael.com/the-virtual-future-of-holocaust-education-is-already-here/" target="_blank" rel="noopener">The Times of Israel: The 'virtual' future of Holocaust education is already here</a></li>
                  </ul>
                </li>
              </ul>
              
              <strong>Project Contibuters</strong>
  </div>
</div>

@endsection