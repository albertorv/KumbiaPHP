<?php

Load::models('menus');
 
class MenusController extends AppController {

    public function index($page=1) 
    {
        $menu = new Menus();
        $this->listMenus = $menu->getMenus($page);
    }
 
    /**
     * Crea un nuevo platillo para el menú
     */
    public function create ()
    {
      
        if(Input::hasPost('menus')){

            $menu = new Menus(Input::post('menus'));

            if($menu->create()){
                Flash::valid('Platillo agregado al menú');

                Input::delete();
                return;               
            }else{
                Flash::error('Falló al agregar el nuevo platillo');
            }
        }
    }
 
    /**
     * Edita un platillo seleccionado
     */
    public function edit($id)
    {
        $menu = new Menus();
         
        if(Input::hasPost('menus')){
 
            if($menu->update(Input::post('menus'))){
                 Flash::valid('Platillo editado correctamente');
                
                return Redirect::to();
            } else {
                Flash::error('Falló al editar el platillo');
            }
        } else {
            
            $this->menus = $menu->find_by_id((int)$id);
        }
    }
 
    /**
     * Eliminar un platillo seleccionado del menú
     */
    public function delete($id)
    {
        $menu = new Menus();
        if ($menu->delete((int)$id)) {
                Flash::valid('Platillo eliminado del menú');
        }else{
                Flash::error('Falló al eliminar el platillo'); 
        }
 
        return Redirect::to();
    }
}