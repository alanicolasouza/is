<?php
if( !isset($_GET['ajax']) )
	header('Location: http://interative.cc');
	
Wordwebpress::getInstance()->setLayout('ajax')->setView('single')->render();
