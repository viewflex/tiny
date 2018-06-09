<?php

namespace Viewflex\Tiny\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Viewflex\Tiny\Contracts\TinyServiceInterface;
use Viewflex\Tiny\Services\TinyService;
use Viewflex\Tiny\Utility\RouteHelperTrait;

class TinyController extends Controller
{
    use RouteHelperTrait;
    
    /**
     * @var array
     */
    protected $inputs;

    /**
     * @var TinyServiceInterface
     */
    protected $service;


    public function __construct()
    {
        $this->inputs = request()->all();
        $query = config('tiny.query', '\Viewflex\Tiny\Queries\TinyQuery');
        $this->service = new TinyService(new $query);
    }

    /**
     * Store a new url and redirect back with message.
     *
     * @return Response
     */
    public function store()
    {
        $validator = Validator::make($this->inputs, ['url' => 'required']);
        $validator->validate();
        
        $msg = ($hash = $this->service->addUrl($this->inputs['url']))
            ? ('URL ' . $this->inputs['url'] . ' was added with alias: ' . $hash)
            : ('An error occurred. URL ' . $this->inputs['url'] . ' was not added.');


        return redirect()->route('tiny.create')->with('message', $msg);
    }

    /**
     * Show form for creating tiny urls.
     *
     * @return array
     */
    public function create()
    {
        return view('tiny::form', [
            'action_method'         => 'create',
            'form_action'           => $this->currentRouteUrlDir().'/store',
            'title'                 => 'Tiny URL Server',
            'prompt'                => 'Add New URL',
            'message'               => Session::get('message')
        ]);
    }

    /**
     * Display actual url represented by hash.
     *
     * @param string $hash
     * @return array
     */
    public function view($hash)
    {
        return redirect()->away($this->service->getUrlByHash($hash));
    }
    
}
