<?php
	class TemplateRegistro{
		/**
		 * Estructura correo registro clientes b2c
		 *
		 * @param string $a Foo
		 *
		 * @return int $b Bar
		 */
		public function body(){
            try {
                return '<img class="banner-img" width="800" src="cid:welcome" alt="">';
            } catch (Exception $e) {
				throw $e;
			}
        }


	}

