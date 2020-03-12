<!-- in case i want to show an alert success with php -->
<?php echo $this->render('/Views/modules/alert.html',NULL,get_defined_vars(),0); ?>

<h2>Customize your Work</h2>

<form method="post" class="pure-form pure-form-stacked">

 <table class="pure-table pure-table-bordered list-align">
     <thead>
         <tr>
             <th></th>
             <th>Insert a Value</th>
             <th></th>
             <th>Your Entries</th>
             <th>Delete</th>
         </tr>
     </thead>
     <tbody>

         <tr>
             <td><strong>Which instrument(s) can you teach?</strong></td>
             <td><input type="text" name="set-instrument"></td>
             <td><input type="submit" class="pure-button" value="Insert"></td>
             <td>
                 <select name="" id="">
                     <option value="">Sassofono Test</option>
                 </select>
             </td>
             <td><input type="submit" class="pure-button" value="Delete"></td>
         </tr>

    </tbody>

 </table>










</form>

