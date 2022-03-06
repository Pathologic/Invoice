<?php
if (isset($params['mgrOnly']) && $params['mgrOnly'] == 'Да' && !$modx->getLoginUserID('mgr')) return;
switch ($modx->event->name) {
    case 'OnPageNotFound':
        $uri = $_SERVER['REQUEST_URI'];
        if (preg_match('/^\/invoice\/[\d]+\/[a-f0-9]{32}\/?$/', $uri)) {
            $uri = trim($uri, '/');
            $parts = explode('/', $uri);
            $id = $parts[1];
            $hash = $parts[2];
            $processor = $modx->commerce->loadProcessor();
            $order = $processor->loadOrder($id);
            if (!empty($order['hash']) && $order['hash'] == $hash && isset($params['page'])) {
                $modx->systemCacheKey = '';
                $processor->getCart();
                $modx->toPlaceholders(['order' => $order]);
                $modx->sendForward($params['page']);
            }
        }
        break;
    case 'OnWebPageInit':
        if(!empty($modx->documentIdentifier) && $modx->documentIdentifier == $params['page']) {
            $modx->sendErrorPage();
        }
    case 'OnWebPagePrerender':
        if(!empty($modx->documentIdentifier) && $modx->documentIdentifier == $params['page']) {
            $modx->event->stopPropagation();
        }
    case 'OnManagerBeforeOrderRender':
        $params['groups']['order_info']['fields']['id']['content'] = function ($data) {
            return '#' . $data['id'] . '<br><a target="_blank" href="' . MODX_SITE_URL . 'invoice/' . $data['id'] . '/' . $data['hash'] . '/">Накладная</a>';
        };
        break;
}
