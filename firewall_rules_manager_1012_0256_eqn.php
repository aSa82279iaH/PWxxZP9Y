<?php
// 代码生成时间: 2025-10-12 02:56:31
namespace App\Http\Controllers;

use App\Models\FirewallRule; // Assuming there's a FirewallRule Eloquent model
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Exception;

class FirewallRulesManager extends Controller
{
    /**
     * Display a listing of the firewall rules.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $rules = FirewallRule::all();
            if ($rules->isEmpty()) {
                return response()->json(['message' => 'No firewall rules found.'], Response::HTTP_NOT_FOUND);
            }
            return response()->json($rules);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Database query error.', 'error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (Exception $e) {
            return response()->json(['message' => 'An error occurred.', 'error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a new firewall rule.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'ip' => 'required|string|max:255',
                'port' => 'required|integer',
                'protocol' => 'required|string|max:10',
                'action' => 'required|string|max:10'
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $rule = new FirewallRule($request->all());
            $rule->save();

            return response()->json(['message' => 'Firewall rule added successfully.', 'rule' => $rule], Response::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Database query error.', 'error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (Exception $e) {
            return response()->json(['message' => 'An error occurred.', 'error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified firewall rule.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $rule = FirewallRule::find($id);
            if (!$rule) {
                return response()->json(['message' => 'Firewall rule not found.'], Response::HTTP_NOT_FOUND);
            }

            $validator = Validator::make($request->all(), [
                'ip' => 'string|max:255',
                'port' => 'integer',
                'protocol' => 'string|max:10',
                'action' => 'string|max:10'
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $rule->update($request->all());

            return response()->json(['message' => 'Firewall rule updated successfully.', 'rule' => $rule]);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Database query error.', 'error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (Exception $e) {
            return response()->json(['message' => 'An error occurred.', 'error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified firewall rule.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $rule = FirewallRule::find($id);
            if (!$rule) {
                return response()->json(['message' => 'Firewall rule not found.'], Response::HTTP_NOT_FOUND);
            }

            $rule->delete();

            return response()->json(['message' => 'Firewall rule deleted successfully.']);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Database query error.', 'error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (Exception $e) {
            return response()->json(['message' => 'An error occurred.', 'error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
