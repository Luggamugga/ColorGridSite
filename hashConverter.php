<?php include "header.php"?>
   <label>
       Input Text:
       <input type="text" id="hash-input-text">
   </label>
    <label>
        Select Hash Type:
        <select name="hash-type" id="hash-type-select">
            <option value="md5">md5</option>
            <option value="sha256">sha256</option>
        </select>
    </label>
<button type="button" id="convert-button">Convert</button>
<textarea readonly id="hash-output"></textarea>
<script type="module" >
    import {hashConvert} from "/hashConvert";
    hashConvert()
</script>
<?php include "footer.php"?>