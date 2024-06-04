<?php

namespace App\Http\Controllers;
use App\Models\Metsltr;
use Illuminate\Http\Request;
use App\Imports\MetsltrImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class CargaMasivaSltrController extends Controller
{
    public function mostrarFormularioCarga()
    {
        return view('metsltr.carga-masiva');
    }

public function cargarDatos(Request $request)
{
    try {
        // Validar el formulario
        $validator = Validator::make($request->all(), [
            'archivo_csv' => 'required|file|mimes:csv,txt',
        ]);

        if ($validator->fails()) {
            return redirect('/metsltr')->withErrors($validator)->withInput();
        }

        // Obtener el archivo CSV desde la solicitud
        $file = $request->file('archivo_csv');

        // Guardar el archivo en almacenamiento temporal
        $path = $file->storeAs('temp', 'temp_file.csv');

        // Ruta completa al archivo
        $filePath = storage_path('app/' . $path);

        // Nombre de la tabla en PostgreSQL
        $tableName = 'nombre_de_tu_tabla';

        // Ejecutar el comando COPY para cargar datos desde el archivo CSV
        DB::statement("COPY $tableName FROM '$filePath' DELIMITER ',' CSV HEADER");

        // Redireccionar a la vista de index con un mensaje de éxito
        return redirect('/metsltr')->with('notification', 'Datos cargados exitosamente.');
    } catch (\Exception $e) {
        // Manejar cualquier error que pueda ocurrir durante la carga masiva
        return redirect('/metsltr')->with('error', 'Error al cargar los datos: ' . $e->getMessage());
    }
}

}
