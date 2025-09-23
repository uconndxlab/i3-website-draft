@extends('layouts.app')
@section('title', 'Beyond Nuremberg')
@section('meta_description', 'Players of this VR time-travel quest will investigate Holocaust history as it unfolded in what is today Western Ukraine. With the aid of an archivist-guide, individuals journey across time and space to collect clues at different sites.')

@section('content')

<style>
.main-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  max-width: 1100px;
  margin: 0 auto;
  padding: 0 50px;


}

@media(max-width: 768px) {
  .main-container {
    padding: 0 20px;
  }
}

.text-container {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

</style>

<div class="main-container pt-5">
  <h1>Beyond Nuremberg</h1>
  <h3 class="widget-title">A VR History Quest</h3>

  <div class="line-height-1_8">
    <div>
      <div>
        <div>
          <div>
            <div class="text-container">
              <span data-contrast="none">Players of this VR time-travel quest will investigate Holocaust history as it unfolded in what is today Western Ukraine. With the aid of an archivist-guide, individuals journey across time and space to collect clues at different sites. These include Courtroom 600 in 1946, where the Trial of the Major War Criminals is underway before the International Military Tribunal (IMT) in Nuremberg, Germany. With the aid of feedback loops that support a levelling-up of mastery, the player collects, analyzes, and pieces together a story told across documents, maps, photographs, oral histories, objects, and other primary sources related to the Holocaust as perpetrated and experienced in the Reichkommisariat Ukraine under the administration of Alfred Rosenberg, Reich Minister for the Occupied Eastern Territories, and his subordinate Erich Koch, who implemented policies in that region.   </span>
              <b><span data-contrast="none">The Tuchyn Story </span></b>
              <span data-contrast="none">Next, the story moves beyond Nuremberg as trial evidence connects Rosenberg and Koch to the small town of Tuchyn and its Jewish community—a community that mounted an armed uprising in 1942 and was decimated under their command. Here, just months before the revolt, the player explores a garment factory where a spool of thread, crust of bread, and other items reveal the stories of individuals who experienced theft of property, the grind of forced labor, starvation, and the other lived realities of the Reich's murderous policies. This progression connects legal accountability with lived experience, revealing both the administrative machinery of genocide and its devastating impacts on specific people. Players learn their stories, their strategies for resistance, for survival, and the continued work of remembrance. </span>
              <span data-contrast="none">Eyewitness stories from survivors and those who sought to bring to bring perpetrators to justice for their Crimes Against Humanity are at the heart of this game's mission to foster awareness of the human impacts and legacies of Holocaust and IMT history for a digital generation. As recent reports indicate, broad cultural knowledge of the Holocaust in the U.S. is in decline among younger generations even as misinformation and outright denial of historical facts—including the evidence presented at Nuremberg—continue to proliferate online. Beyond Nuremberg aims to engage 18- to 34-year-olds who are among the 65% percent of U.S. adults who play video games. Complex interrelated narratives that unfold across time and space, while demanding skills acquisition and mastery, are not only core features of our plans for Beyond Nuremberg, they are also common and highly valued aspects of games.</span>
              <figure class="text-muted fst-italic small">
                <img class="alignright wp-image-3788 size-large" src="https://dev-greenhouse-studios.pantheonsite.io/wp-content/uploads/2020/05/Charrette-scaled-2-1024x554.jpg" alt="" width="100%" height="auto" />
                <figcaption style="margin-top: 10px;">External and UConn advisors, including colleagues from the United States Holocaust Memorial Museum, Memorium Nürnberger Prozesse, and The Museum of Jewish Civilization, deliberated with the Beyond Nuremberg team in Summer of 2019 as part of Greenhouse Studios' iterative design process.</figcaption>
              </figure>
              <strong>Next Step: Prototyping </strong>
              Supported by numerous grants including an NEH Digital Projects for the Public Discovery Grant, the team consists of faculty, designers, and students at the University of Connecticut Greenhouse Studios and UNC Greensboro. In 2019, an international board of scholarly advisors met with the UConn team as part of Greenhouse Studios' iterative design process. The group reviewed early-stage concepts and discussed issues surrounding the adaptation of serious historical subject matter to this digital medium.
              We are currently testing early-stage prototypes—both informally and formally—to explore larger conceptual possibilities as well as refine key in-game mechanics. Examples include how players choose when and where to travel to a specific time and place and how to best guide players in querying the objects that they discover so that they can unlock the clues and stories each item holds. These other early decision points design benefit from quick, informal feedback loops that allow rapid iteration on core mechanics and spatial design while we're still in a flexible phase of early development.
              <strong>Critical Making and Broader Implications for Digital Public Humanities </strong>
              <figure id="attachment_3678" class="small text-muted fst-italic wp-caption alignright" aria-describedby="caption-attachment-3678">
                <img class="alignright wp-image-6325 size-full" src="https://dev-greenhouse-studios.pantheonsite.io/wp-content/uploads/2022/08/thumbnail_DSC03943-1-1024x685-1.jpeg" alt="" width="100%" height="auto" />
                <figcaption style="margin-top: 10px;">Attendee at 2020 ED Games Expo, a showcase of government-supported educational learning games and technologies, explores an early Courtroom 600 proof-of-concept.</figcaption>
              </figure>
              In addition to developing new open-source software (the Archive Access Plug-in) that allows materials in online repositories to be rendered and “handled” in Unity3D environments, the project's interdisciplinary team of game developers, historians, instructional designers, archivists, students, and others is also interrogating methodological, ethical, and practical issues raised by using headset-based interactive VR as a medium for history telling and learning. This practice of critical making is, in essence, "attentive learning-by-doing." So while the Greenhouse Studios-UConn and UNC Greensboro team are, indeed, making a playable VR game, we also treat the researching, testing, and start-to-finish iterative making of Beyond Nuremberg as an opportunity to interrogate the many questions that arise along the way. These queries include: how the mixed temporal frames of VR “time travel” impact historical understanding; how to deliver sufficient context in an interactive experience; what safeguards are needed to curb misuse of content by “bad actors”; and how to ethically handle visual representations of traumatic themes and perpetrators in a 3D digital context where the emotional impacts of virtual embodiment are not yet well understood.
              <em>Development of Beyond Nuremberg is supported by a National Endowment for the Humanities Digital Projects for the Public Discovery Grant, a University of Connecticut Research Excellence Program and School of Fine Arts Dean's Grant; funding from The Dodd Center and the UConn Office of Global Affairs, and a UNC Greensboro Internal Research Award.</em>
              &nbsp;
              <strong><em>Beyond Nuremberg</em> in the News:</strong>
              <ul>
                <li style="list-style-type: none;">
                  <ul>
                    <li>"Beyond Nuremberg: A Prototype Playtest," showcase at <a href="https://www.digitalmemorylab.com/events/" target="_blank" rel="noopener">Inaugural Connective Holocaust Commemoration Expo 2025</a>, Landecker Digital Memory Lab, University of Sussex, England.</li>
                    <li>"Beyond Nuremberg: Critical Game Making as Public History Research," 2023 <a href="https://www.uni.lu/c2dh-en/events/beyond-nuremberg-critical-game-making-as-public-history-research/" target="_blank" rel="noopener">History@Play lecture</a> , Centre for Contemporary and Digital History (C²DH), University of Luxembourg.</li>
                    <li><a href="https://youtu.be/QAtibihA2XU" target="_blank" rel="noopener">A Virtual Reality Encounter with Evidence of the Holocaust</a> presentation at <em>The Digitalisation of Memory: Technology - Possibilities - Boundaries</em>,  a 2021 symposium of the Falstad Centre and Museum (Norway) and POLIN Museum (Poland).</li>
                    <li>Courtroom 600 Team Immerses Users in Nuremberg Trials at the 2020 ED Games Expo</li>
                    <li><a href="https://www.apa.org/monitor/2019/09/games-impact" rel="noopener">Monitor on Psychology: Games with Impact</a></li>
                    <li><a href="https://today.uconn.edu/2019/01/reviving-holocaust-history-virtual-reality/" rel="noopener">UConn Today: Engaging Holocaust History with Virtual Reality</a></li>
                    <li><a href="https://theconversation.com/digital-technology-offers-new-ways-to-teach-lessons-from-the-holocaust-102023" rel="noopener">The Conversation: Digital technology offers new ways to teach lessons from the Holocaust</a></li>
                    <li><a href="https://www.timesofisrael.com/the-virtual-future-of-holocaust-education-is-already-here/" rel="noopener">The Times of Israel: The ‘virtual' future of Holocaust education is already here</a></li>
                  </ul>
                </li>
              </ul>
              &nbsp;
              <hr />
              <strong>Project Team: </strong>
              <ul>
                <li>Clarissa J. Ceglio / Associate Director of Research, Greenhouse Studios at UConn;
                  Associate Professor, Digital Media and Design Department
                </li>
                <li>Anne Parsons / Director of Public History, Department of History, Jewish Studies, and Women, Gender, and Sexuality Studies at UNC Greensboro</li>
                <li>Varun Saxena / Post-MFA Fellow in Interactive Design, College of Visual and Performing Arts, UNC Greensboro</li>
                <li>Graham Stinnett / Archivist for Human Rights and Alternative Press Collections</li>
                <li>Ken Thompson / Assistant Professor, Digital Media and Design Department</li>
                <li>
                  Graduate and Undergraduate Student Researchers
                  <ul>
                    <li>Sasha Steffey, programmer, UNC Greensboro</li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div>
        <div><strong>Project Alumni: </strong></div>
        <ul>
          <li>Greg Colati / Assistant University Librarian for University Archives, Special Collections &amp; Digital Curation</li>
          <li>Tom Lee / formerly Design Technologist, Greenhouse Studios at UConn</li>
          <li>Avinoam Patt /currently Maurice and Corinne Greenberg Professor of Holocaust Studies at New York University and Ingeborg H. and Ira Leon Rennert Director at the NYU Center for the Study of Antisemitism</li>
          <li>Stephen T. Slota / formerly Assistant Professor-in-Residence of Educational Technology, Department of Educational Psychology, Neag School of Education jointly with the Digital Media and Design Department</li>
        </ul>
      </div>
    </div>
  </div>
</div>

@endsection