<?php

namespace App\Http\Controllers;

use App\Helpers\BSForm;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Store variables, which will be sent to view automatically.
     *
     * @var array
     */
    protected $data = [];

    protected $view = 'public.';
    protected $route = '';

    /**
     * Store public storage object.
     */
    protected $storage;

    /**
     * Store request object.
     */
    protected $request;

    /**
     * current logged-in user.
     */
    protected $user;

    /**
     * Breadcrumb links.
     */
    protected $breadcrumbs;

    public function __construct()
    {
        $this->storage = Storage::disk('public');
        $this->request = request();
    }

    public function setView($view)
    {
        $this->view .= $view.'.';
    }

    public function setRoute($route)
    {
        $this->route .= $route.'.';
    }

    public function header()
    {
        if (Auth::check()) {
            $this->user = Auth::user();
        }
    }

    public function view($file = 'index')
    {
        $this->data['bsform'] = new BSForm();
        $this->data['user'] = $this->user;
        $this->data['storage'] = $this->storage;
        $this->data['request'] = $this->request;
        $this->data['breadcrumbs'] = $this->breadcrumbs;

        return view($this->view.$file, $this->data);
    }

    public function route($file, $id = ''): string
    {
        if (empty($id)) {
            return route($this->route.$file);
        } else {
            return route($this->route.$file, $id);
        }
    }

    public function notfound(string $file = '')
    {
        $this->breadcrumbs = ['name' => 'Not Found', 'url'=> '#'];
        if (empty($file)) {
            return $this->view('404');
        } else {
            return $this->view($file);
        }
    }
}
