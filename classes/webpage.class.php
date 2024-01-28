<?php
// Checks if the URL contains "classes/" or "includes/"
if (strpos($_SERVER['PHP_SELF'], 'classes/') !== false || strpos($_SERVER['PHP_SELF'], 'includes/') !== false) {
    header('Location: ../index.php');
    exit();
}

// Class to set data to webpage
class Webpage {
    // Properties
    private $title;
    private $currentActive;
    private $stylesheet;
    private $script;

    // Method to assign title and current active
    public function __construct($title, $active) {
        $this->title = $title;
        $this->currentActive = $active;
    }

    // Method to assign active to appropriate tag
    public function setActive($element) {
        echo $element == $this->currentActive ? 'active text-bg-light' :  '';
    }

    // Method to get title
    public function getTitle() {
        echo $this->title;
    }

    // Method to display timetable button
    public function showButton() {
        echo strpos($_SERVER['PHP_SELF'], 'index.php') ? '' : 'd-none';
    }

    // Method to set stylesheet
    public function setStyleSheet($link) {
        $this->stylesheet = $link;
    }

    // Method to get stylesheet
    public function getStyleSheet() {
        echo strlen($this->stylesheet) == 0 ? '' : '<link rel="stylesheet" href="' . $this->stylesheet . '">';
    }

    // Method to set script
    public function setScript($link) {
        $this->script = $link;
    }

    // Method to get script
    public function getScript() {
        echo strlen($this->script) == 0 ? '' : '<script src="' . $this->script . '"></script>';
    }
}
