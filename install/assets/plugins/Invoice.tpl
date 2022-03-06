//<?php
/**
 * Invoice
 * 
 * Shows order data in a separate page
 * 
 * @category    plugin
 * @version     1.0.1
 * @internal    @properties &page=Страница для вывода;text; &mgrOnly=Только для менеджеров;list;Да,Нет;Нет
 * @internal    @events OnManagerBeforeOrderRender,OnWebPageInit,OnWebPagePrerender,OnPageNotFound
**/

return require MODX_BASE_PATH . 'assets/plugins/invoice/plugin.invoice.php';
