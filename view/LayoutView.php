<?php

class LayoutView{


    /**
     * @param ContainerView $ContainerView
     * @param NavigationView $NavigationView
     * @param $isLoggedIn
     */
    public function render(ContainerView $ContainerView, NavigationView $NavigationView, $isLoggedIn){
        echo'
        <!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>To do list</title>
          <link rel="stylesheet" type="text/css" href="css/style.css">
        </head>
        <body>
            <div id="page">
                <div id="header">
                    '
                    .
                        $this->generateHeader($isLoggedIn)
                    .
                    '
                </div>
                <div id="nav">
                    '
                    .
                        $NavigationView->response($isLoggedIn)
                    .
                    '
                </div>
                <div id="container">
                    '.
                        $this->renderContent($ContainerView, $isLoggedIn)
                    .'
                </div>
            </div>
         </body>
      </html>
        ';
    }

    /**
     * @param ContainerView $ContainerView
     * @param $isLoggedIn
     * @return string
     */
    private function renderContent(ContainerView $ContainerView, $isLoggedIn){

        $ret = '';
        $ret = $ContainerView->response($isLoggedIn);
        
        return $ret;
        
    }

    /**
     * @param $isLoggedIn
     * @return string
     */
    private function generateHeader($isLoggedIn){
        if($isLoggedIn){
            return '<h1>To do list</h1>';
        }
        else{
            return '<h1>Welcome</h1>';
        }
        
    }
}