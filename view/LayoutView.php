<?php

class LayoutView{
    
    public function render(ContainerView $ContainerView, NavigationView $NavigationView){
        echo'
        <!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>To do list</title>
          <link rel="stylesheet" type="text/css" href="css/style.css">
        </head>
        <body>
            <div id="header">
                '
                .
                    $this->generateHeader()
                .
                '
            </div>
            <div id="nav">
                '
                .
                    $NavigationView->response(false)
                .
                '
            </div>
            <div id="container">
                '.
                    $this->renderContent($ContainerView)
                .'
            </div>
         </body>
      </html>
        ';
    }
    
    private function renderContent(ContainerView $ContainerView){
        
        //LOGIC FOR TYPE OF CONTENT RENDERED
        $ret = '';
        $ret = $ContainerView->response();
        
        return $ret;
        
    }
    
    private function generateHeader(){
        return '<h1>To do list</h1>';
    }
}