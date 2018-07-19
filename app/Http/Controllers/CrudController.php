<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Crud;

class CrudController extends Controller
{

    protected $folder = 'crud';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view($this->folder.'/index');
    }

    public function data(){
   $crud = Crud::orderBy('id','desc')->get();
            return Datatables::of($crud)->addColumn('action',function($data){
                $html ='';
                $html .= '<button  data-source='.url('crud/'.$data->id.'/edit').' class="btn btn-success btn-sm btn-modal" data-title="Edit Data" data-toggle="modal" data-target="#modal" data-button="Ubah"><i class="material-icons">edit</i></button> ';

                // $html .= csrf_field();
                // $html .= method_field("DELETE");
                $html .= '<button data-url="'.url('crud/'.$data->id).'" class="btn btn-delete btn-danger btn-sm"><i class="material-icons">delete_outline</i>';

                return $html;
            })
            ->make(true);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view($this->folder.'/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // print_r($request->all());
        $text = $request->text;

        // validasi
        if (empty($text)) {
            $title = "Gagal";
            $message = 'Gagal Menyimpan Data,Data Harus Diisi';
            $type = 'danger';

        }
        else{
        $crud  = new Crud;
        $crud->text = $text;
        $save = $crud->save();

        if ($save) {
            $title = "Sukses";
            $message = 'Berhasil Menyimpan Data';
            $type = 'success';

        }
        else{
            $title = "Gagal";
            $message = 'Gagal Menyimpan Data';
            $type = 'danger';

        }


        }

        $json = [
        'title'=>$title,
        'message'=>$message,
        'type'=>$type,
        'state'=>'show'
        ]  ;
        return $json;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = Crud::find($id);
        return view($this->folder.'/edit',compact('data'));;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
                $text = $request->text;

        // validasi
        if (empty($text)) {
            $title = "Gagal";
            $message = 'Gagal Menyimpan Data,Data Harus Diisi';
            $type = 'danger';

        }
        else{
        $crud  = Crud::find($id);
        $crud->text = $text;
        $save = $crud->save();

        if ($save) {
            $title = "Sukses";
            $message = 'Berhasil Mengubah Data';
            $type = 'success';

        }
        else{
            $title = "Gagal";
            $message = 'Gagal Mengubah Data';
            $type = 'danger';

        }


        }

        $json = [
        'title'=>$title,
        'message'=>$message,
        'type'=>$type,
        'state'=>'show'
        ]  ;
        return $json;


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $crud  = Crud::find($id);
        if (count($crud) > 0 ) {
        $delete = $crud->delete();

        if ($delete) {
            $title = "Sukses";
            $message = 'Berhasil Menghapus Data';
            $type = 'success';

        }
                else{
            $title = "Gagal";
            $message = 'Gagal Menghapus Data';
            $type = 'danger';

        }



        }
        else{
            $title = "Gagal";
            $message = 'Gagal Menghapus Data';
            $type = 'danger';

        }


        $json = [
        'title'=>$title,
        'message'=>$message,
        'type'=>$type,
        'state'=>'show'
        ]  ;
        return $json;

    }
}
