<form method="get" class="searchform" action="<?php echo esc_url(home_url()); ?>/">
  <input type="text"
         value="Search"
         name="s"
         id="s"
         onblur="if (this.value == '') {this.value = 'Search';}"
         onfocus="if (this.value == 'Search') {this.value = '';}" />
  <button type="submit" class="sidebar-search fa fa-search"></button>
</form>
