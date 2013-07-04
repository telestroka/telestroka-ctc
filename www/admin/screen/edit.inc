<?=$alert->ALERT_SCRIPT;?>
<form class="mainform" name="screen_add" method="post" action="<?=$site->PAGES[$site->PAGE]['url'];?>" enctype="multipart/form-data" onsubmit="return screen_check(this);">
    <input type="hidden" name="id" value="<?=$screen_id;?>" />
    <span class="alert">*</span> Идентификатор:<br/>
    <input name="name" type="text" maxlength="255" onclick="this.style.background='white'" value="<?=htmlspecialchars($screen_name, ENT_QUOTES);?>"/>
    <div class="alert"><?=$alert_name;?></div>
    <br/>
    <span class="alert">*</span> Название канала:<br/>
    <input name="title" type="text" maxlength="255" onclick="this.style.background='white'" value="<?=htmlspecialchars($screen_title, ENT_QUOTES);?>"/>
    <div class="alert"><?=$alert_title;?></div>
    <br/>
    Слоган:<br/>
    <input name="slogan" type="text" maxlength="255" onclick="this.style.background='white'" value="<?=htmlspecialchars($screen_slogan, ENT_QUOTES);?>"/>
    <div class="alert"><?=$alert_slogan;?></div>
    <br/>
    Описание:<br/>
    <textarea name="info" rows="10" cols="17" onclick="this.style.background='white'"><?=htmlspecialchars($screen_info, ENT_QUOTES);?></textarea>
    <div class="alert"><?=$alert_info;?></div>
    <br/>
    <span class="alert">*</span> Прайс:<br/>
    <textarea name="price_list" rows="10" cols="17" onclick="this.style.background='white'"><?=htmlspecialchars($screen_price_list, ENT_QUOTES);?></textarea>
    <div class="alert"><?=$alert_price_list;?></div>
    <br/>
    Изображение:<br/>
    <input type="file" name="image"/>
    <div class="alert"><?=$alert_image;?></div>
    <br/>
    Востребованность:<br/>
    <input name="rate" type="text" maxlength="255" onclick="this.style.background='white'" value="<?=htmlspecialchars($screen_rate, ENT_QUOTES);?>"/>
    <div class="alert"><?=$alert_rate;?></div>
    <br/>
    Дата:<br/>
    <input type="text" name="date" maxlength="255" onclick="this.style.background='white'" value="<?=htmlspecialchars($screen_date, ENT_QUOTES);?>"/>
    <div class="alert"><?=$alert_date;?></div>
    <br/>
    Рубрика:<br/>
    <?
      echo '<ul>';
      foreach ($smi_parts as $part_id => $part_params)
      {
        $screen_sects = $screen->SqlGetPartObjects($part_id, 'screen_sects');
        echo '<li>' . $part_params['title'] . '</li>';
        echo '<ul>';
        foreach ($screen_sects as $sect_id => $sect_params)
        {
          $screen_cats = $screen->SqlGetSectObjects($sect_id, 'screen_cats');
          echo '<li>' . $sect_params['title'] . '</li>';
          echo '<ul style="list-style-type: none;">';
          foreach ($screen_cats as $cat_id => $cat_params)
          {
            echo '<li>';
            if ($cat_id == $screen_cat) echo '<input type="radio" name="cat" value="' . $cat_id . '" checked="checked" style="width: auto;"/>';
            else echo '<input type="radio" name="cat" value="' . $cat_id . '" style="width: auto;"/>';
            echo $cat_params['title'];
            echo '<br/></li>';
          }
          echo '</ul>';
        }
        echo '</ul>';
      }
      echo '</ul>';
    ?>
    <br/><br/>
    <button type="submit">Сохранить изменения</button>
    <div class="alert"><?=$result;?></div>
</form>