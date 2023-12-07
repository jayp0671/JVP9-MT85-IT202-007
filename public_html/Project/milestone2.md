<table><tr><td> <em>Assignment: </em> IT202 Milestone 2 API Project</td></tr>
<tr><td> <em>Student: </em> Jay Patel (jvp9)</td></tr>
<tr><td> <em>Generated: </em> 12/7/2023 4:56:33 PM</td></tr>
<tr><td> <em>Grading Link: </em> <a rel="noreferrer noopener" href="https://learn.ethereallab.app/homework/IT202-007-F23/it202-milestone-2-api-project/grade/jvp9" target="_blank">Grading</a></td></tr></table>
<table><tr><td> <em>Instructions: </em> <ol><li>Checkout Milestone2 branch</li><li>Create a new markdown file called milestone2.md</li><li>git add/commit/push immediate</li><li>Fill in the below deliverables</li><li>At the end copy the markdown and paste it into milestone2.md</li><li>Add/commit/push the changes to Milestone2</li><li>PR Milestone2 to dev and verify</li><li>PR dev to prod and verify</li><li>Checkout dev locally and pull changes to get ready for Milestone 3</li><li>Submit the direct link to this new milestone2.md file from your GitHub prod branch to Canvas</li></ol><p>Note: Ensure all images appear properly on github and everywhere else. Images are only accepted from dev or prod, not local host. All website links must be from prod (you can assume/infer this by getting your dev URL and changing dev to prod).</p></td></tr></table>
<table><tr><td> <em>Deliverable 1: </em> Define the appropriate table or tables for your API </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Screenshots of the table definition SQL files</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fjvp9%2F2023-12-07T04.07.331.png.webp?alt=media&token=994b5f2a-44cb-4506-9c2c-eadd453e7a13"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is the code for my table. For my application, I only need<br>one table. This is the &quot;Recipes&quot; table. This table holds id, created, modified,<br>title, ingredients, instructions, servings, and source (Manual or API).<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fjvp9%2F2023-12-07T04.09.202.png.webp?alt=media&token=d76f5b27-caf2-475d-9515-ebaf4a210bdf"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is what my table looks like in the database. The id, created,<br>and timestamp are as expected. Title holds the title of the recipe (text).<br>The ingredients holds the ingredients of the recipe (text). The instructions hold the<br>instructions on how to make that recipe (text). The servings holds how many<br>servings the recipe makes (int), and the source holds whether or not the<br>data was API generated or manually created.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Mappings</td></tr>
<tr><td> <em>Response:</em> <p>The only table I have is the &quot;Recipes&quot; table. The columns are id,<br>created, modified, title, ingredients, instructions, servings, and source. The &quot;id&quot; column acts as<br>an identifier for each recipe. The &quot;created&quot; and &quot;modified&quot; columns are timestamps capturing<br>when a recipe record was created and last modified. The &quot;title&quot; column corresponds<br>to the title of the recipe and is mapped to the title data<br>from the external API (or from manual data). Similarly, the &quot;ingredients&quot; and &quot;instructions&quot;<br>columns store the ingredient list and step-by-step instructions, respectively, sourced from the external<br>API (or from manual data). The &quot;servings&quot; column holds the information about the<br>number of servings the recipe makes. Finally, the &quot;source&quot; column distinguishes between recipes<br>added manually and those fetched from the API, containing values such as &quot;API&quot;<br>or &quot;Manual.&quot;<br></p><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add any related PRs for this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/jayp0671/JVP9-MT85-IT202-007/pull/55">https://github.com/jayp0671/JVP9-MT85-IT202-007/pull/55</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 2: </em> Data Creation Page </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Screenshots of the Page and the Code (at least two)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fjvp9%2F2023-12-07T04.27.39Filled%20out%20form.png.webp?alt=media&token=046d3b73-9d44-4c4c-a9d6-6900462e8f74"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is what the form looks like. This form asks the user to<br>put a recipe into the database. As shown in the image, the title<br>takes in text parameter. Both ingredients and instructions also take in text parameters<br>and they also have expandable text boxes based on the user&#39;s preference. Finally,<br>the servings takes in an integer. Although not shown in the image, the<br>servings parameter cannot go lower than 1. The webpage will not let the<br>user enter a number lower than one.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fjvp9%2F2023-12-07T04.35.06Successful%20creation%20message.png.webp?alt=media&token=95338ddc-b2e3-4fa7-8879-f33ce76c0a20"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is the message that is displayed after the user successfully uploads the<br>recipe to the database. I put the message right under the submit button<br>so the user can clearly see it after submitting it. <br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fjvp9%2F2023-12-07T04.39.17Please%20fill%20out%20this%20field.png.webp?alt=media&token=24dd0c6c-872a-43d2-8c09-f4cdcd603da1"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is what is shown when a user leaves a text box blank.<br>Although this is just one image for one scenario, the same error message<br>is shown if the user is to leave any other text boxes blank.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fjvp9%2F2023-12-07T04.41.06Value%20greater%20than%20or%20equal%20to%20one.png.webp?alt=media&token=73f122b9-1728-4680-87a5-e8293d6d3dcc"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is the error that is shown when the user tries to submit<br>the form while having a number less than or equal to 0 in<br>the servings section.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fjvp9%2F2023-12-07T04.42.38Recipe%20with%20same%20title.png.webp?alt=media&token=74de9814-1258-4e43-afb7-2adb65da1222"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is what happens when the user tries to make a recipe with<br>the same title as another recipe already present in the database. This is<br>to prevent duplicates in the database. <br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fjvp9%2F2023-12-07T04.57.38shii.png.webp?alt=media&token=8bec3fde-bbdb-4b43-beaa-1e19b917f22e"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is a part of the code for my create recipe program. Here<br>you can see how my code is able to get the data from<br>the form and send it to the database while also checking for duplicates.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Database Results</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fjvp9%2F2023-12-07T05.02.19everything.png.webp?alt=media&token=e9d9a1f1-de3d-4791-b073-d3669c582517"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is what the data looks like in the database. The column all<br>the way on the right shows the manual data and the API data.<br>The manual data is the one I showed in the previous screenshot. <br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Misc Checklist</td></tr>
<tr><td> <em>Response:</em> <div>The uniqueness of entities is maintained through (id) in the "Recipes" table, ensuring<br>each recipe has a distinct identifier. To handle duplicates from manually added items,<br>the code checks for recipes with the same title before insertion, alerting the<br>user if a duplicate is detected. Similarly, the code also works the same<br>way for API created data (this is a separate addition which I will<br>show in a later deliverable). In terms of access control for data creation,<br>all roles have access to create recipes. The form for creating a new<br>recipe is universally accessible to users of different roles.</div><br></td></tr>
<tr><td> <em>Sub-Task 4: </em> Add a direct link to this file on Heroku Prod</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://jvp9-prod-586c4f946e9c.herokuapp.com/Project/create_recipe.php">https://jvp9-prod-586c4f946e9c.herokuapp.com/Project/create_recipe.php</a> </td></tr>
<tr><td> <em>Sub-Task 5: </em> Add any related PRs for this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/jayp0671/JVP9-MT85-IT202-007/pull/57">https://github.com/jayp0671/JVP9-MT85-IT202-007/pull/57</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 3: </em> Data List Page </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Screenshot the list page and code</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fjvp9%2F2023-12-07T05.11.19Hella%20Lotta%20Stuff.png.webp?alt=media&token=d6616fc1-e760-4839-9588-bb8f6c468b6b"/></td></tr>
<tr><td> <em>Caption:</em> <p>This one screenshot fits a lot of the requirements. For starters, you can<br>see that all data is either labeled as Manual or API in the<br>Source column. There is also filtering options on the top. The filtering options<br>include filter by either ascending/descending order by title/servings (the dropdown menus). I implemented<br>a search bar but this was after this section was already filled out,<br>the search bar will be featured in the final demo video, but if<br>the user searches a recipe and it isn&#39;t there, an error message is<br>displayed. The limit of records is also present. As you can see, it<br>is set to 10 by default. Each item does have a link to<br>edit, delete, or view. Styling is applied so it looks user-friendly and nice.<br>And the screenshot is also from Heroku prod. <br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fjvp9%2F2023-12-07T05.20.09Title%20Ascending%2010.png.webp?alt=media&token=7d820296-512d-4202-853d-6314e2789d5f"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is an example of the sorting feature. This sorts the list from<br>lowest serving size to the biggest serving size.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fjvp9%2F2023-12-07T05.21.37Servings%20Descending%202.png.webp?alt=media&token=51dd1659-8992-45e8-87ac-1b1693fa50f3"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is an example of sorting by descending order by serving size, except<br>the user only wanted a two recipe limit<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fjvp9%2F2023-12-07T05.28.27Data%20List.png.webp?alt=media&token=dffc9b37-0115-49a8-8309-aa130e6cf781"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is the code to my data list page (not including the styling<br>code, only the php code). This shows the code for the filtering, actually<br>displaying the data in a table format, and the action buttons for each<br>row. <br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Explanation</td></tr>
<tr><td> <em>Response:</em> <p>My data list page is only accessible by users with the Admin role.<br>And yes, the user must be logged in to view this page, but<br>only admins can view this page. The only roles that can access and<br>use the view, edit, and delete action buttons are users who have the<br>admin role. This page shows every recipe that has been added to the<br>database, either by API or manually. The filters are filtered by limit, which<br>allows the user to put a specific number of recipes on the page<br>(max 100, default 10). The user can also sort the list in ascending/descending<br>order either by title or by serving size. Another feature NOT SHOWN is<br>the search bar, where the user can search for a recipe title, and<br>if it&#39;s not present an error message is shown. This will be featured<br>in the final demo.&nbsp;<br></p><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add a direct link to this file on Heroku Prod</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://jvp9-prod-586c4f946e9c.herokuapp.com/Project/my_recipes.php">https://jvp9-prod-586c4f946e9c.herokuapp.com/Project/my_recipes.php</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Add any related PRs for this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/jayp0671/JVP9-MT85-IT202-007/pull/58">https://github.com/jayp0671/JVP9-MT85-IT202-007/pull/58</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 4: </em> View Details Page </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Screenshot of Page and related content/code</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fjvp9%2F2023-12-07T05.32.23View%20Details.png.webp?alt=media&token=67085a1e-fffe-4723-b1ee-6167df818630"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is the view details page for one of the recipes. Starting from<br>the top, you can see it has been fetched by id and passed<br>through query parameters in the url. Styling has been applied. The ingredients are<br>shown as a bullet-list and the sections are bolded. The data isn&#39;t necessarily<br>more detailed (talked to the profesor about this and he said that displaying<br>the entire recipe in the data list page is fine). And the page<br>contains links to edit and delete the entity. <br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fjvp9%2F2023-12-07T05.38.23Recipe%20not%20found.png.webp?alt=media&token=e67e1b1d-d711-4d4d-aae4-65155e8ab03c"/></td></tr>
<tr><td> <em>Caption:</em> <p>In the url, I put &#39;69&#39; to make the application take me to<br>recipe id 69, but since there isn&#39;t one, it brings me back to<br>the list page with an error message displayed at the top. <br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fjvp9%2F2023-12-07T05.42.07PEEKABO.png.webp?alt=media&token=c353f4ce-c19d-424c-bc23-5e8e6f903a19"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is my code foe the view recipe (view details) page (excluding the<br>formatting). This shows how the user gets redirected if a recipe isn&#39;t found<br>and also the code to show the recipe. <br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Explanation</td></tr>
<tr><td> <em>Response:</em> <p>This view shows the entire recipe in a user-friendly way. It has the<br>title, then a list of the ingredients. It then has the instructions for<br>the recipe and the servings it makes. It is the full recipe shown<br>in a user-friendly and easy-to-read manner. Since only admin accounts can view the<br>data list page, only admin accounts can use the edit/delete buttons/links on the<br>page. This page is inaccessible to regular users.<br></p><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add a direct link to this file on Heroku Prod</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://jvp9-prod-586c4f946e9c.herokuapp.com/Project/view_recipe.php?id=24">https://jvp9-prod-586c4f946e9c.herokuapp.com/Project/view_recipe.php?id=24</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Add any related PRs for this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/jayp0671/JVP9-MT85-IT202-007/pull/58">https://github.com/jayp0671/JVP9-MT85-IT202-007/pull/58</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 5: </em> Edit Data Page </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Screenshot of Page and related content/code</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fjvp9%2F2023-12-07T19.39.31Edit%20type.png.webp?alt=media&token=0cebc0e7-973e-4a19-a0d3-a343e3d06715"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is what editing a recipe from the database looks like. The url<br>is from heroku prod as shown. The entity is also fetched by id<br>passed through query parameters in the URL. The design and style is the<br>same as the rest of the website and the information is displayed nicely.<br>THe form is similar to the &quot;create recipe&quot; page with the form having<br>the same format. The form is prefilled with the existing rntity&#39;s information for<br>the respective fields. The form also has the correct data types for each<br>property being requested [text for title, ingredients, and instructions and int for servings<br>(int has to be more than or equal to 1)]. <br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fjvp9%2F2023-12-07T19.48.43error%20type%20shi.png.webp?alt=media&token=137e7458-2885-446a-a131-358beee19a7e"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is what the user is redirected to when they enter a recipe<br>id that does not exist in the database yet.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fjvp9%2F2023-12-07T19.51.56FILL%20THE%20DAMN%20THIGN%20OTU.png.webp?alt=media&token=457fe3b2-a4f2-4f77-9ff2-3398f49581ac"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is what happens if the user leaves any entity blank when they<br>try to submit the form. This is similar to the other text fields<br>in the application, and the user is also not allowed to enter a<br>number less than 1.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fjvp9%2F2023-12-07T19.54.10Updated%20Recipe.png.webp?alt=media&token=a920134c-ea5e-42c1-8bbd-1402d7ebb577"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is what is shown after the user updates the recipe. The same<br>change is also reflected in the database and in the data list page.<br><br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fjvp9%2F2023-12-07T20.01.22edit%20recipe%20code.png.webp?alt=media&token=43646c5b-afff-4020-932e-276b68b567d7"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is my code toe the edit recipe page (not including the formatting<br>code). Here you can see the process of how the code gets the<br>recipe based on its id (redirecting it if it isn&#39;t available), then connecting<br>to the database to actually get the recipe data and then updating the<br>database with the new changes. The user is then redirected to the view_recipe<br>page. <br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add a direct link to this file on Heroku Prod</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://jvp9-prod-586c4f946e9c.herokuapp.com/Project/view_recipe.php?id=24">https://jvp9-prod-586c4f946e9c.herokuapp.com/Project/view_recipe.php?id=24</a> </td></tr>
<tr><td> <em>Sub-Task 3: </em> Add any related PRs for this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/jayp0671/JVP9-MT85-IT202-007/pull/59">https://github.com/jayp0671/JVP9-MT85-IT202-007/pull/59</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 6: </em> Delete Handling </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Screenshots of related code/evidence</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fjvp9%2F2023-12-07T19.57.52BEFORE.png.webp?alt=media&token=9ba14086-4d04-427a-9add-ebc6dc2335e3"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is my data list page before I delete the recently updated Chicken<br>Parmesan recipe. As you can see, there are currently 4 recipes in the<br>list. The current filter sorts the recipes by title (alphabetical). This page is<br>only accessible by admins, so only admins can use the delete action button.<br><br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fjvp9%2F2023-12-07T19.58.29AFTER.png.webp?alt=media&token=f00e8cae-5bcb-4c6b-b8c3-56c7e59c5aa6"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is my data list page after I delete the recently updated Chicken<br>Parmesan recipe. As you can see, there are now only 3 recipes in<br>the page (and the database) and there is a success message at the<br>top indicating that that recipe was indeed deleted. The updated list is still<br>sorting the recipes alphabetically by its title. <br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fjvp9%2F2023-12-07T20.10.45delete%20recipe.png.webp?alt=media&token=3c3965f5-2e2d-4ed2-89c0-a9c1797fc196"/></td></tr>
<tr><td> <em>Caption:</em> <p>This code, although it doesn&#39;t require the navigation bar or the id check<br>necessarily, is still present for the sake of the assignment. other than that,<br>this is the code that first looks at what recipe is wanted to<br>be deleted, and then administers the process and deletes it from the database.<br><br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Explanation</td></tr>
<tr><td> <em>Response:</em> <div>In this system, only administrators have the authority to delete recipes from the<br>data list, as access to the data list page is restricted to users<br>with the admin role. The deletion process is a hard delete, permanently eradicating<br>the recipe entity from the database upon pressing the delete button. To restore<br>a deleted recipe, users can either manually add the details or retrieve the<br>recipe from the API. The code implementation provides clarity on the deletion process<br>(showed in the screenshot above). After a deletion, the list page reverts to<br>its default setting, arranging the recipes alphabetically by title name.</div><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add any related PRs for this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/jayp0671/JVP9-MT85-IT202-007/pull/60">https://github.com/jayp0671/JVP9-MT85-IT202-007/pull/60</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 7: </em> API Handling </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Screenshots of Code</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fjvp9%2F2023-12-07T20.36.41search_recipe.png.webp?alt=media&token=50644a56-728e-4266-bf25-207ca724db3a"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is the code handling for my page to search recipes. This code<br>takes the user input for a recipe name, the code then combs the<br>API to look for recipe titles with matching names, and it then displays<br>a list of them to the user. The user can then add any<br>recipe from that list to the database (each recipe card comes with a<br>button that allows the user to add the recipe to the database). The<br>code will then add that recipe to the database, mark it as API,<br>and will bring the user back to the search recipe page. If a<br>recipe already exists in the database with the SAME TITLE, it will give<br>the user an error message telling them that a recipe with the same<br>title already exists and will take them back to the search recipe page.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fjvp9%2F2023-12-07T20.43.57Deep's%20enchilada.png.webp?alt=media&token=73de41f1-3b7c-4e7d-96ee-e2ca638f70c3"/></td></tr>
<tr><td> <em>Caption:</em> <p>I searched up &quot;Enchilada&quot; in the text box and this is what is<br>shown/ As you can see, there are separate recipe cards for each recipe<br>and each card comes with an &quot;add database&quot; button. <br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fjvp9%2F2023-12-07T20.46.00Recipe%20added%20to%20database%20successfully.png.webp?alt=media&token=bac9d4f6-8491-4640-8f50-43195426ac08"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is what it looks like when the user adds a recipe to<br>the database.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fjvp9%2F2023-12-07T20.48.38Same%20title%20exists.png.webp?alt=media&token=c47b7ac4-133d-47e5-8aaa-b08a31970c49"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is what it looks like when the user tries to add a<br>recipe in the database that already exists in the database.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fjvp9%2F2023-12-07T20.51.42Recipe%20table%20FINAL.png.webp?alt=media&token=3ec71845-03f6-4414-9858-b96a5d337d82"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is what the table looks like in the database after it has<br>been updated from the website.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Explanation</td></tr>
<tr><td> <em>Response:</em> <div>The API and database work together to bring in recipe information. When you<br>look for recipes or add a new one, that's when the app talks<br>to the external recipe API. The idea is to give users a wide<br>range of recipes to choose from, making their collection more interesting. So, you<br>can search for recipes from this external source and easily add them to<br>your own collection (the database). It's all about making sure you have a<br>diverse set of recipes to explore and enjoy in one place!</div><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add any related PRs for this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/jayp0671/JVP9-MT85-IT202-007/pull/56">https://github.com/jayp0671/JVP9-MT85-IT202-007/pull/56</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 8: </em> Misc </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> What issues did you face and overcome during this milestone?</td></tr>
<tr><td> <em>Response:</em> <p>The biggest issue I faced during this milestone was that I accidentally chose<br>the wrong API. At first, I had a weather API. I was most<br>likely absent on the day he mentioned we shouldn&#39;t use weather API but<br>I tried to use it and realized it was difficult to do this<br>project. When I asked him about it, he told me to switch APIs<br>as it would make life easier, and it did! Working with the Recipe<br>API has been straightforward and optimal so far. There have been minor issues<br>along the way, but nothing too bad that would make me restart that<br>section or be stuck on it for a long time. Any issue I<br>had I just did research and messed around with the code to try<br>and fix it.<br></p><br></td></tr>
<tr><td> <em>Sub-Task 2: </em> What did you find the easiest?</td></tr>
<tr><td> <em>Response:</em> <p>I found the delete handling to be the easiest, mostly because it took<br>the least amount of time. To be honest, the view details, edit, and<br>delete handling all together were easy, they didn&#39;t take too long and any<br>issues I encountered weren&#39;t major issues and easily fixable.<br></p><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> What did you find the hardest?</td></tr>
<tr><td> <em>Response:</em> <p>I found the manual and API data to be the hardest.&nbsp; Not that<br>it was difficult per se, it&#39;s just the time it took for both<br>those sections. I spent most of my time in Milestone 2 in those<br>sections, and the errors I encountered weren&#39;t too bad tho. Other than that,<br>nothing else was hard, just time consuming.<br></p><br></td></tr>
<tr><td> <em>Sub-Task 4: </em> Did you have to utilize any unanticipated APIs?</td></tr>
<tr><td> <em>Response:</em> <p>Well I did have a Weather API before this, but after switching to<br>the Recipe API, I did not have to utilize any unanticipated APIs. The<br>Recipe API is easy enough to work with.<br></p><br></td></tr>
<tr><td> <em>Sub-Task 5: </em> Add a screenshot of your project board</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fjvp9%2F2023-12-07T21.53.43Project%20Board.png.webp?alt=media&token=4d3876db-ea87-41c7-86bc-5e95a429bc57"/></td></tr>
<tr><td> <em>Caption:</em> <p>I had to zoom out to get all the problems in frame so<br>I apologize for the weird formatting. All problems were mostly minor and were<br>fixed.<br></p>
</td></tr>
</table></td></tr>
</table></td></tr>
<table><tr><td><em>Grading Link: </em><a rel="noreferrer noopener" href="https://learn.ethereallab.app/homework/IT202-007-F23/it202-milestone-2-api-project/grade/jvp9" target="_blank">Grading</a></td></tr></table>