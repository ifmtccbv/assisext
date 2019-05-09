<?php

class Campus {
	private $id_campus;
	private $campus;

        public function getId_campus() {
            return $this->id_campus;
        }

        public function setId_campus($id_campus) {
            $this->id_campus = $id_campus;
        }

        public function getCampus() {
            return $this->campus;
        }

        public function setCampus($campus) {
            $this->campus = $campus;
        }

}

?>