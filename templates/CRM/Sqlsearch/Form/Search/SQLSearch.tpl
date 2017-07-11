{*-------------------------------------------------------+
| SYSTOPIA SQL Contact Search (Caution)                  |
| Copyright (C) 2017 SYSTOPIA                            |
| Author: B. Endres (endres -at- systopia.de)            |
| http://www.systopia.de/                                |
+--------------------------------------------------------+
| This program is released as free software under the    |
| Affero GPL license. You can redistribute it and/or     |
| modify it under the terms of this license which you    |
| can read by viewing the included agpl.txt or online    |
| at www.gnu.org/licenses/agpl.html. Removal of this     |
| copyright header is strictly prohibited without        |
| written permission from the original author(s).        |
+-------------------------------------------------------*}

{include file="CRM/Contact/Form/Search/Custom.tpl"}

<div class="sql-search">
  <!--div class="crm-section">
    <div class="label">{$form.search_select.label}
      <a onclick='CRM.help("{ts domain="de.systopia.moregreetings"}Instructions{/ts}", {literal}{"id":"id-token-help","file":"CRM\/moregreetings\/Form\/Settings"}{/literal}); return false;' href="#" title="{ts domain="de.systopia.moregreetings"}Help{/ts}" class="helpicon">&nbsp;</a>
    </div>
    <div class="content">
      <code>
        contact_a.id           as contact_id,<br/>
        contact_a.contact_type as contact_type,<br/>
        contact_a.sort_name    as sort_name,
      </code>
      {$form.search_select.html}
    </div>
    <div class="clear"></div>
  </div-->

  <div class="crm-section">
    <div class="label">{$form.search_from.label}
      <a onclick='CRM.help("{ts domain="de.systopia.moregreetings"}Instructions{/ts}", {literal}{"id":"id-token-help","file":"CRM\/moregreetings\/Form\/Settings"}{/literal}); return false;' href="#" title="{ts domain="de.systopia.moregreetings"}Help{/ts}" class="helpicon">&nbsp;</a>
    </div>
    <div class="content">
      <code>FROM civicrm_contact contact_a</code><br/>
      {$form.search_from.html}
    </div>
    <div class="clear"></div>
  </div>

  <div class="crm-section">
    <div class="label">{$form.search_where.label}
      <a onclick='CRM.help("{ts domain="de.systopia.moregreetings"}Instructions{/ts}", {literal}{"id":"id-token-help","file":"CRM\/moregreetings\/Form\/Settings"}{/literal}); return false;' href="#" title="{ts domain="de.systopia.moregreetings"}Help{/ts}" class="helpicon">&nbsp;</a>
    </div>
    <div class="content">{$form.search_where.html}</div>
    <div class="clear"></div>
  </div>
</div>

<!-- move to the right spot -->
<script type="text/javascript">
cj("div.crm-submit-buttons").first().after(cj("div.sql-search"));
</script>