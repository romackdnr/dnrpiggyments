						
            <div class="alert"> Page Successfully Saved! </div>

            <form id="form_page" action="" method="post">
            
            <fieldset>
              <legend>New Page</legend>
              <ul>
                <li><label for="page_name"> Page Name: </label>
                  <input type="text" id="page_name" name="page_name"></li>
                <li><label for="page_nav"> Navigation Label: <em>(optional)</em> </label>
                  <input type="text" id="page_nav" name="page_nav"></li>
                  
                <li><label for="editor1"> Content Manager: </label>
                  <textarea cols="80" rows="10" class="ckeditor" id="editor1" name="editor1"> </textarea></li>
              </ul>
            </fieldset>
            
            <fieldset>
              <legend>Meta Tags</legend>
              <ul>
                <li><label for="page_title"> Page Title: </label>
                  <input type="text" id="page_title" name="page_title"></li>
                <li><label for="meta_keys"> Meta Keywords: </label>
                  <textarea cols="" rows="" id="meta_keys" name="meta_keys"></textarea></li>
                <li><label for="meta_desc"> Meta Descriptions: </label>
                  <textarea cols="" rows="" id="meta_desc" name="meta_desc"></textarea></li>
                <li><label for="google_meta"> Google Meta Tags: </label>
                  <textarea cols="" rows="" id="google_meta" name="google_meta"></textarea></li>
                <li><label for="google_trackers"> Google Analytics Tracker: </label>
                  <textarea cols="" rows="" id="google_trackers" name="google_trackers"></textarea></li>
              </ul>
            </fieldset>
            
            <div class="iecol1 center"><button type="submit">Save Page</button> &nbsp; <button type="reset">Clear Page</button></div>
            </form>
